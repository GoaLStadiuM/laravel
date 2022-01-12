<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Kick;
use App\Models\NftPayment;
use App\Models\Training;
use App\Models\TrainingSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateInterval;
use DateTime;
use DateTimeZone;

class GameController extends Controller
{
    private const STATS_CAP = 171, // a
                  STATS_CAP_PERCENTAGE = 90; // b

    public function characterList(): JsonResponse
    {
        return response()->json([
            'ok' => true,
            'version' => 0,
            'characters' => Auth::user()
                            ->characters()
                            ->join('base_character', 'character.base_id', '=', 'base_character.id')
                            ->join('xp_for_level', function($join) {
                                $join->on('character.division', '=', 'xp_for_level.division')
                                        ->on('character.level', '=', 'xp_for_level.level');
                            })
                            ->select(
                                'character.id as character_id',
                                'character.base_id as model_id',
                                'character.name as character_name', // could be null
                                'base_character.name as base_name', // in such case use default
                                'character.division',
                                'character.level',
                                'character.strength',
                                'character.accuracy',
                                DB::raw('(character.strength + character.accuracy) * 90 / 171 as percentage'),
                                'character.xp',
                                'xp_for_level.xp_for_next_level'
                            )
                            ->get()
        ]);
    }

    public function play(): JsonResponse
    {
        $now = new DateTime(null, new DateTimeZone('UTC'));
        $currentHour = $now->format('H');
        $currentMinute = $now->format('i');

        $window = [
            $now->modify("$currentHour:00:00"),
            $now->modify("$currentHour:30:00")
        ];

        return response()->json([
            'ok' => true,
            'version' => 0,
            'play' => [
                'is_it_time_to_kick' => $this->isItTimeToKick($currentHour, $currentMinute),
                'kicks_left' => Auth::user()
                            ->characters()
                            ->join('kick', 'kick.character_id', 'character.id')
                            ->join('kicks_per_division', 'kicks_per_division.division', 'character.division')
                            ->select(
                                'character.character_id',
                                DB::raw('kicks_per_division.kicks - COUNT(`kick`.character_id) as kicks_left')
                            )
                            ->whereNotNull('kick.reward')
                            ->whereBetween('kick.created_at', $window)
                            ->groupBy('character.character_id')
                            ->having('kicks_left', '>', '-1')
                            ->get()
                            ->pluck('kicks_left', 'id')
            ]
        ]);
    }

    public function kick(int $character_id): JsonResponse
    {
        $now = new DateTime(null, new DateTimeZone('UTC'));
        $currentHour = $now->format('H');
        $currentMinute = $now->format('i');

        if (!$this->isItTimeToKick($currentHour, $currentMinute))
            abort(403, "Sorry, you're late (or early).");

        $character = Character::where([
            'id' => $character_id,
            'user_id' => Auth::user()->id
        ])->firstOrFail();

        $window = [
            $now->modify("$currentHour:00:00"),
            $now->modify("$currentHour:30:00")
        ];

        if (!$character->canKick($window))
            abort(403, "You don't have any kicks left.");

        $kick = $character->latestKick(/* '30 minutes ago' */)->firstOrCreate(
            [ 'character_id' => $character->id ],
            //                                   c                                              * b                           / a
            [ 'result' => (random_int(1, 100) <= (($character->strength + $character->accuracy) * self::STATS_CAP_PERCENTAGE) / self::STATS_CAP) ]
        );

        return response()->json([
            'ok' => true,
            'version' => 0,
            'kick' => $kick->result
        ]);
    }

    public function reward(int $character_id): JsonResponse
    {
        $user = Auth::user();
        $character = Character::where([
            'id' => $character_id,
            'user_id' => $user->id
        ])->firstOrFail();

        $kick = $character->latestKick(/* '30 minutes ago' */)->firstOrFail();
        $kick->reward = $kick->result ? 123.456 : 0; // todo reward formula
        $kick->save();

        $user->gls += $kick->reward;
        $user->save();

        return response()->json([
            'ok' => true,
            'version' => 0,
            'reward' => $kick->reward
        ]);
    }

    private function isItTimeToKick(string $currentHour, string $currentMinute): bool
    {
        return true;//in_array($currentHour, [ '00', '04', '08', '12', '16', '20' ]) && intval($currentMinute) < 30;
    }

    public function menu()
    {
        return view('penalties.menu');
    }

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

        $gameConfig = config('game');
        $maxHours = $training->session->max_hours;
        $timezone = new DateTimeZone('UTC');
        $start = new DateTime($training->created_at, $timezone);
        $now = new DateTime(null, $timezone);

        $diff = $start->diff($now);
        if (!is_numeric($diff->h))
            abort(403, 'Unknown error. Please, contact support.');

        if (intval($diff->y) > 0 || intval($diff->m) > 0 || intval($diff->d) > 0 || intval($diff->h) >= $maxHours)
        {
            $hours = $maxHours;
        }

        else
        {
            $hours = intval($diff->h);
        }

        $training->done = true;
        $training->save();

        if ($hours > 0)
        {
            // Stats Reward
            $pip = $gameConfig['CHARACTER_INCREASE_PERCENTAGE'];
            $character = $training->character;
            $character->strength += ($character->strength * $pip) * $hours;
            $character->accuracy += ($character->accuracy * $pip) * $hours;
            $character->save();

            // Goal Reward
            $user = Auth::user();
            $user->goal += ((($character->payment->product->price * $gameConfig['CHARACTER_REWARD_PERCENTAGE']) * $hours) / $gameConfig['GOAL_PRICE_IN_BUSD']) * .2;
            $user->save();
        }

        return redirect()->route('farming');
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
                'end_time' => (new DateTime($training->created_at, new DateTimeZone('UTC')))->add(new DateInterval("PT{$training->session->max_hours}H"))->format('Y-m-d H:i:s')
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
