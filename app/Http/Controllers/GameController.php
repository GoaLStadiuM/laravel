<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Division;
use App\Models\Training;
use App\Models\TrainingSession;
use App\Models\Product;
use App\Traits\GLSToken;
use App\Traits\GoalToken;
use DateInterval;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    use GLSToken, GoalToken;

    private int $minutes = 29, $seconds = 59;
    private array $allowed_hours = [ '00', '04', '08', '12', '16', '20' ];

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
                ->join('xp_for_level', fn(JoinClause $join) =>
                    $join->on('character.division', '=', 'xp_for_level.division')
                         ->on('character.level', '=', 'xp_for_level.level')
                )
                ->rightJoin('training', fn(JoinClause $join) =>
                    $join->on('training.character_id', '=', 'character.id')
                         ->where('training.done', '=', false)
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
                    DB::raw("(`character`.`strength` + `character`.`accuracy`) * $max_percentage / $max_stats as percentage"),
                    'character.xp',
                    'xp_for_level.xp_for_next_level',
                    'training.done',
                    'training.stopped',
                    'training.created_at',
                    'training.updated_at'
                )
                ->get()
        ]);
    }

    /**
     * @throws Exception
     */
    public function startTraining(int $character_id, int $session_id): JsonResponse
    {
        $character = Character::where([
            'id' => $character_id,
            'user_id' => Auth::user()->id
        ])->firstOrFail();

        $session = TrainingSession::findOrFail($session_id);

        if ($character->isTraining())
            abort(403, 'The character is already training.');

        if ($character->checkTraining($session_id, new DateTime('- 1 day', new DateTimeZone('UTC'))))
            abort(403, "It's been less than 24 hours since you did that training session.");

        $training = new Training;
        $training->character_id = $character->id;
        $training->session_id = $session->id;
        $training->save();

        return response()->json([
            'ok' => true,
            'version' => 0,
            'end_time' => (new DateTime(strval($training->created_at), new DateTimeZone('UTC')))
                            ->add(new DateInterval("PT{$session->max_hours}H"))
                            ->format('Y-m-d H:i:s')
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws Exception
     */
    public function stopTraining(int $character_id): JsonResponse
    {
        $character = Character::where([
            'id' => $character_id,
            'user_id' => Auth::user()->id
        ])->firstOrFail();

        $training = $character->currentTraining();
        $maxHours = $training->session->max_hours;
        $timezone = new DateTimeZone('UTC');
        $start = new DateTime(strval($training->updated_at), $timezone);
        $now = new DateTime('now', $timezone);

        $diff = $start->diff($now);
        if (!is_numeric($diff->h))
            abort(403, 'Unknown error. Please, contact support.');

        $hours = $diff->y > 0 || $diff->m > 0 || $diff->d > 0 || $diff->h >= $maxHours
            ? $maxHours
            : intval($diff->h);

        $training->hours += $hours;

        $rewards = [
            'goal' => 0,
            'str' => 0,
            'acc' => 0
        ];

        if ($hours > 0)
        {
            if ($training->hours >= $maxHours)
                $training->done = true;

            $character = $training->character;
            $max_stats = $character->maxStats();

            if ($this->checkMaxStats($character, $max_stats))
            {
                // Goal Reward
                $rewards['goal'] = $this->calculateFarmingReward(
                                        strval($character->payment->product->price),
                                        Character::REWARD_PERCENTAGE
                                    ) * $hours;
                $user = Auth::user();
                $user->goal += $rewards['goal'];
                $user->save();
            }

            else
            {
                // Stats Reward
                $rewards['str'] = ($character->strength * Character::INCREASE_PERCENTAGE) * $hours;
                $rewards['acc'] = ($character->accuracy * Character::INCREASE_PERCENTAGE) * $hours;
                $character->strength += $rewards['str'];
                $character->accuracy += $rewards['acc'];

                // not sure about this but just in case
                if (($character->strength + $character->accuracy) > $max_stats)
                    $this->setStatsToMax($character, $max_stats);

                $character->save();
            }
        }

        $training->stopped = true;
        $training->save();

        return response()->json([
            'ok' => true,
            'version' => 0,
            'rewards' => $rewards
        ]);
    }

    /**
     * @throws Exception
     */
    public function resumeTraining(int $character_id): JsonResponse
    {
        $character = Character::where([
            'id' => $character_id,
            'user_id' => Auth::user()->id
        ])->firstOrFail();

        $training = $character->currentTraining();

        if ($training->doesntExist())
            abort(403, 'The character is not currently training.');

        $training->stopped = false;
        $training->save();

        $remaining_time = $training->session->max_hours - $training->hours;

        return response()->json([
            'ok' => true,
            'version' => 0,
            'end_time' => (new DateTime(strval($training->updated_at), new DateTimeZone('UTC')))
                            ->add(new DateInterval("PT{$remaining_time}H"))
                            ->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * @throws Exception
     */
    public function play(): JsonResponse
    {
        $timeChecks = $this->getTimeChecks();

        return response()->json([
            'ok' => true,
            'version' => 0,
            'play' => [
                'is_it_time_to_kick' => $this->isItTimeToKick(...$timeChecks[0]),
                'kicks_left' => Auth::user()
                    ->characters()
                    ->leftJoin('kick', fn($join) =>
                        $join->on('kick.character_id', '=', 'character.id')
                             ->whereNotNull('kick.reward')
                             ->whereBetween('kick.created_at', $timeChecks[1])
                    )
                    ->join('kicks_per_division', 'kicks_per_division.division', 'character.division')
                    ->select(
                        'character.id',
                        DB::raw('`kicks_per_division`.`kicks` - COUNT(`kick`.`reward`) as kicks_left')
                    )
                    ->groupBy('character.id', 'kicks_per_division.kicks')
                    ->having('kicks_left', '>', '-1')
                    ->get()
                    ->pluck('kicks_left', 'id')
            ]
        ]);
    }

    /**
     * @throws Exception
     */
    public function kick(int $character_id): JsonResponse
    {
        $stuff = $this->timeCheck($character_id);
        $character = $stuff[0];

        // check if the character is in a training session
        if ($character->isTraining())
            abort(403, 'The character is currently in a training session.');

        $div = new Division(Division::FIRST_DIVISION);
        $max_percentage = $div->getMaxPercentage();
        $max_stats = $div->getMaxStats();

        $result = Auth::user()->id === 2 ||
            //                     c                                              * b                / a
            (random_int(1, 100) <= (($character->strength + $character->accuracy) * $max_percentage) / $max_stats);

        $kick = $character->currentKickOrCreate(
            $stuff[1],
            [
                'kick.character_id' => $character->id,
                'result' => $result
            ]
        );

        return response()->json([
            'ok' => true,
            'version' => 0,
            'kick' => $kick->result
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws Exception
     */
    public function kickReward(int $character_id): JsonResponse
    {
        $stuff = $this->timeCheck($character_id);
        $character = $stuff[0];

        $kick = $character->currentKick($stuff[1])->firstOrFail();
        $kick->reward = 0;

        $currentLvl = $character->level;

        if ($kick->result)
        {
            // +1 xp (hardcoded)
            $character->xp++;
            $this->lvlUp($character, $character->payment->product);
            $character->save();

            // set the reward
            $kick->reward = strval($this->calculateKickReward($character, Product::priceFromCharacter($character)) * 0.55);

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

    /**
     * @throws Exception
     */
    private function timeCheck(int $character_id): array
    {
        $timeChecks = $this->getTimeChecks();

        if (!$this->isItTimeToKick(...$timeChecks[0]))
            abort(403, "Sorry, you're late (or early).");

        $character = Character::where([
            'id' => $character_id,
            'user_id' => Auth::user()->id
        ])->firstOrFail();

        if (!$character->canKick($timeChecks[1]))
            abort(403, "You don't have any kicks left.");

        return [ $character, $timeChecks[1] ];
    }

    /**
     * @throws Exception
     */
    private function getTimeChecks(): array
    {
        $timezone = new DateTimeZone('UTC');
        $now = new DateTime('now', $timezone);
        $currentHour = $now->format('H');
        $currentMinute = $now->format('i');
        $begin = new DateTime('now', $timezone);
        $end = new DateTime('now', $timezone);

        return [
            [
                $currentHour,
                $currentMinute
            ],
            [
                $begin->modify("$currentHour:00:00"),
                $end->modify("$currentHour:$this->minutes:$this->seconds")
            ]
        ];
    }

    private function isItTimeToKick(string $currentHour, string $currentMinute): bool
    {
        return Auth::user()->id === 2 || in_array($currentHour, $this->allowed_hours) && intval($currentMinute) <= $this->minutes;
    }

    private function lvlUp(Character $character, int $startingLvl): void
    {
        $xpForLevel = $character->xpForLevel();
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

        // if it's time then lvl up the character (unless it's already maxed out)
        if ($xpForLevel[$character->level] !== 0 && $currentXp >= $xpForLevel[$character->level])
            $character->level++;
    }

    // true if character hit max stats, false otherwise
    private function checkMaxStats(Character $character, int $max_stats): bool
    {
        return intval(floatval($character->strength) + floatval($character->accuracy)) === $max_stats;
    }

    private function setStatsToMax(Character $character, int $max_stats): void
    {
        $x = ((floatval($character->strength) + floatval($character->accuracy)) - $max_stats) / 2;

        $character->strength -= $x;
        $character->accuracy -= $x;
        // from now on checkMaxStats will always return true
    }

    private function calculateFarmingReward(string $product_price, string $reward_percentage): string
    {
        return bcdiv(bcmul($product_price, $reward_percentage, self::$DECIMALS), $this->goalPrice(), self::$DECIMALS);
    }

    private function calculateKickReward(Character $character, string $price): string
    {
        //                       product_price_in_busd / goal_price_in_busd
        $product_price_in_goal = bcdiv($price, $this->goalPrice(), self::$DECIMALS);
        $product_price_in_gls = bcmul($product_price_in_goal, strval($this->GOAL_PRICE_IN_GLS), self::$DECIMALS);
        $roi = '45'; // days
        $hours_in_a_day = 24;
        $hours_between_windows = 4;
        $windows_per_day = $hours_in_a_day / $hours_between_windows;
        $wins_per_day = ($windows_per_day * $character->kicksPerWindow()) * ($character->startingPercentage() / 100);

        return bcdiv(bcdiv($product_price_in_gls, $roi, self::$DECIMALS), strval($wins_per_day), self::$DECIMALS);
    }
}
