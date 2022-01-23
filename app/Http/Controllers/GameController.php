<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Division;
use App\Models\Kick;
use App\Models\NftPayment;
use App\Models\Training;
use App\Models\TrainingSession;
use App\Models\Product;
use App\Traits\GLSToken;
use App\Traits\GoalToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateInterval;
use DateTime;
use DateTimeZone;

class GameController extends Controller
{
    use GLSToken, GoalToken;

    public function characterList(): JsonResponse
    {
        $div = new Division(Division::FIRST_DIVISION);
        $max_percentage = $div->getMaxPercentage();
        $max_stats = $div->getMaxStats();

        return response()->json([
            'ok' => true,
            'version' => 0,
            'characters' => Auth::user()
                ->characters()
                ->join('base_character', 'character.base_id', '=', 'base_character.id')
                ->join('xp_for_level', fn($join) =>
                    $join->on('character.division', '=', 'xp_for_level.division')
                            ->on('character.level', '=', 'xp_for_level.level')
                )
                ->select(
                    'character.id as character_id',
                    'character.base_id as model_id',
                    'character.name as character_name', // could be null
                    'base_character.name as base_name', // in such case use default
                    'character.division',
                    'character.level',
                    'character.strength',
                    'character.accuracy',
                    DB::raw("(character.strength + character.accuracy) * $max_percentage / $max_stats as percentage"),
                    'character.xp',
                    'xp_for_level.xp_for_next_level'
                )
                ->get()
        ]);
    }

    public function play(): JsonResponse
    {
        $now = new DateTime('now', new DateTimeZone('UTC'));
        $currentHour = $now->format('H');
        $currentMinute = $now->format('i');
        $begin = new DateTime('now', new DateTimeZone('UTC'));
        $end = new DateTime('now', new DateTimeZone('UTC'));

        return response()->json([
            'ok' => true,
            'version' => 0,
            'play' => [
                'is_it_time_to_kick' => $this->isItTimeToKick($currentHour, $currentMinute),
                'kicks_left' => Auth::user()
                            ->characters()
                            ->leftJoin('kick', fn($join) =>
                                $join->on('kick.character_id', '=', 'character.id')
                                     ->whereNotNull('kick.reward')
                                     ->whereBetween('kick.created_at', [
                                        $begin->modify("$currentHour:00:00"),
                                        $end->modify("$currentHour:29:59")
                                    ])
                            )
                            ->join('kicks_per_division', 'kicks_per_division.division', 'character.division')
                            ->select(
                                'character.id',
                                DB::raw('kicks_per_division.kicks - COUNT(`kick`.reward) as kicks_left')
                            )
                            ->groupBy('character.id', 'kicks_per_division.kicks')
                            ->having('kicks_left', '>', '-1')
                            ->get()
                            ->pluck('kicks_left', 'id')
            ]
        ]);
    }

    public function kick(int $character_id): JsonResponse
    {
        $stuff = $this->timeCheck($character_id);
        $character = $stuff[0];
        $div = new Division(Division::FIRST_DIVISION);
        $max_percentage = $div->getMaxPercentage();
        $max_stats = $div->getMaxStats();

        $kick = $character->currentKickOrCreate(
            $stuff[1],
            [
                'kick.character_id' => $character->id,
                //                                 c                                              * b                / a
                'result' => (random_int(1, 100) <= (($character->strength + $character->accuracy) * $max_percentage) / $max_stats)
            ]
        );

        return response()->json([
            'ok' => true,
            'version' => 0,
            'kick' => $kick->result
        ]);
    }

    public function reward(int $character_id): JsonResponse
    {
        $stuff = $this->timeCheck($character_id);
        $character = $stuff[0];

        $kick = $character->currentKick($stuff[1])->firstOrFail();
        $kick->reward = 0;

        $currentLvl = $character->level;

        if ($kick->result)
        {
            $product = $character->payment->product;

            // +1 xp (hardcoded)
            $character->xp++;
            $this->lvlUp($character, $product);
            $character->save();

            // set the reward
            $kick->reward = $this->calculateKickReward($character, $product);

            // add the reward to the user balance
            $user = Auth::user();
            $user->gls = bcadd($user->gls, $kick->reward, self::$DECIMALS);
            $user->save();
        }

        $kick->save();

        return response()->json([
            'ok' => true,
            'version' => 0,
            'reward' => $kick->reward,
            'level_up' => $currentLvl !== $character->level
        ]);
    }

    private function timeCheck(int $character_id): array
    {
        $now = new DateTime('now', new DateTimeZone('UTC'));
        $currentHour = $now->format('H');
        $currentMinute = $now->format('i');
        $begin = new DateTime('now', new DateTimeZone('UTC'));
        $end = new DateTime('now', new DateTimeZone('UTC'));

        if (!$this->isItTimeToKick($currentHour, $currentMinute))
            abort(403, "Sorry, you're late (or early).");

        $character = Character::where([
            'id' => $character_id,
            'user_id' => Auth::user()->id
        ])->firstOrFail();

        $window = [
            $begin->modify("$currentHour:00:00"),
            $end->modify("$currentHour:29:59")
        ];

        if (!$character->canKick($window))
            abort(403, "You don't have any kicks left.");

        return [ $character, $window ];
    }

    private function isItTimeToKick(string $currentHour, string $currentMinute): bool
    {
        return in_array($currentHour, [ '00', '04', '08', '12', '16', '20' ]) && intval($currentMinute) < 30;
    }

    private function lvlUp(Character $character, Product $product): void
    {
        $xpForLevel = $character->xpForLevel();
        $startingLvl = $product->level;
        $currentXp = $character->xp;

        foreach ($xpForLevel as $lvl => $xpForNextLvl)
        {
            // ignore lower levels
            if ($lvl < $startingLvl)
                continue;

            // stop at current level
            if ($lvl === $character->level)
                break;

            // subtract the xp already used for lvlup
            $currentXp -= $xpForNextLvl;
        }

        // if it's time then lvl up the character
        if ($currentXp >= $xpForLevel[$character->level])
            $character->level++;
    }

    private function calculateKickReward(Character $character, Product $product): string
    {
        //                       product_price_in_busd / goal_price_in_busd
        $product_price_in_goal = bcdiv(strval($product->price), $this->goalPrice(), self::$DECIMALS);
        $product_price_in_gls = bcmul($product_price_in_goal, strval($this->GOAL_PRICE_IN_GLS), self::$DECIMALS);
        $roi = '45'; // days
        // 6 = 24 hours in a day / 4 hours (every window starts 4 hours after the previous one started)
        $wins_per_day = (6 * $character->kicksPerWindow()) * ((new Division($character->division))->getStartingPercentage() / 100);

        return bcdiv(bcdiv($product_price_in_gls, $roi, self::$DECIMALS), strval($wins_per_day), self::$DECIMALS);
    }

    public function menu()
    {
        return view('penalties.menu');
    }

    // more work todo down here

    public function farmingWeb()
    {
        return view('farming.index', [
            'characters' => Auth::user()->characters()->get()
        ]);
    }

    public function claim(int $training_id)
    {
        $training = Training::where('id', $training_id)->where('done', false);
        if ($training->doesntExist())
            abort(404, "The Training doesn't exist or is already completed.");

        $training = $training->first();
        if ($training->character->user->id !== Auth::user()->id)
            abort(403, 'You are not authorized to perform this action.');

        $maxHours = $training->session->max_hours;
        $timezone = new DateTimeZone('UTC');
        $start = new DateTime(strval($training->created_at), $timezone);
        $now = new DateTime('now', $timezone);

        $diff = $start->diff($now);
        if (!is_numeric($diff->h))
            abort(403, 'Unknown error. Please, contact support.');

        $hours = intval($diff->y) > 0 || intval($diff->m) > 0 || intval($diff->d) > 0 || intval($diff->h) >= $maxHours
                    ? $maxHours
                    : intval($diff->h);

        $training->done = true;
        $training->save();

        if ($hours > 0)
        {
            $gameConfig = config('game');
            $max_stats = (new Division($character->division))->getMaxStats();

            $character = $training->character;
            if ($this->checkMaxStats($character, $max_stats))
            {
                // Goal Reward
                $user = Auth::user();
                $user->goal += $this->calculateFarmingReward($character->payment->product->price, $gameConfig['CHARACTER_REWARD_PERCENTAGE']) * $hours;
                $user->save();
            }

            else
            {
                // Stats Reward
                $cip = $gameConfig['CHARACTER_INCREASE_PERCENTAGE'];
                $character->strength += ($character->strength * $cip) * $hours;
                $character->accuracy += ($character->accuracy * $cip) * $hours;

                if (($character->strength + $character->accuracy) > $max_stats)
                    $this->setStatsToMax($character, $max_stats);

                $character->save();
            }
        }

        return redirect()->route('farming');
    }

    // true if character hit max stats, false otherwise
    private function checkMaxStats(Character $character, int $max_stats): bool
    {
        return ($character->strength + $character->accuracy) === $max_stats;
    }

    private function calculateFarmingReward(int $product_price, int $reward_percentage): string
    {
        return bcdiv(bcmul($product_price, $reward_percentage, self::$DECIMALS), $this->goalPrice(), self::$DECIMALS);
    }

    private function setStatsToMax(Character $character, int $max_stats): void
    {
        $x = (($character->strength + $character->accuracy) - $max_stats) / 2;

        $character->strength -= $x;
        $character->accuracy -= $x;
    }

    public function selectTraining(int $payment_id, int $session_id)
    {
        $payment = NftPayment::where('user_id', Auth::user()->id)->where('id', $payment_id);
        if ($payment->doesntExist())
            abort(404, "The Purchase doesn't exist.");

        $character = $payment->first()->character;
        if ($character === null || $character->doesntExist())
            abort(404, "The character doesn't exist.");

        $training = $character->latestTraining;
        if ($training !== null && !$training->done)
            abort(403, 'A training session is already in progress.');

        if (TrainingSession::where('id', $session_id)->doesntExist())
            abort(403, 'The training type is not valid.');

        $training = new Training;
        $training->character_id = $character->id;
        $training->session_id = $session_id;
        $training->save();

        return redirect()->route('stats', $payment_id);
    }

    public function stats(int $payment_id)
    {
        $payment = NftPayment::where('user_id', Auth::user()->id)->where('id', $payment_id);
        if ($payment->doesntExist())
            abort(404, "The Purchase doesn't exist.");

        $character = $payment->first()->character;
        if ($character === null || $character->doesntExist())
            abort(404, "The Character doesn't exist.");

        $training = $character->latestTraining;
        if ($training !== null && !$training->done)
        {
            $view = 'farming.training';
            $data = [
                'character' => $character,
                'training' => $training,
                'end_time' => (new DateTime(strval($training->created_at), new DateTimeZone('UTC')))->add(new DateInterval("PT{$training->session->max_hours}H"))->format('Y-m-d H:i:s')
            ];
        }

        else
        {
            $view = 'farming.stats';
            $data = [
                'character' => $character,
                'sessions' => TrainingSession::get()
            ];
        }

        return view($view, $data);
    }
}
