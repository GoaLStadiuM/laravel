<?php

namespace App\Http\Controllers;

use App\Models\NftPayment;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use DateInterval;
use DateTime;
use DateTimeZone;

class GameController extends Controller
{
    public function menu()
    {
        return view('penalties.menu');
    }

    public function characterList()
    {if (Auth::user()->id === 2) { dd(Auth::user()->characters()->get()); }
        return view('farming.index', [
            'characters' => Auth::user()->characters()
        ]);
    }

    public function claim(int $training_id)
    {
        $training = Training::where('id', $training_id)->where('done', false);
        if ($training->doesntExist() || $training->character->user->id !== Auth::user()->id)
            abort(404, "The Training doesn't exist or is already completed.");

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
            $character = $training->character();
            $character->strengh += ($character->strengh * $pip) * $hours;
            $character->accuracy += ($character->accuracy * $pip) * $hours;
            $character->save();

            // Goal Reward
            $user = Auth::user();
            $user->goal += ((($character->payment->product->price * $gameConfig['CHARACTER_REWARD_PERCENTAGE']) * $hours) / $gameConfig['GOAL_PRICE_IN_BUSD']) * .7;
            $user->save();
        }

        return redirect()->route('farming');
    }

    public function selectTraining(int $payment_id, int $session_id)
    {
        $payment = NftPayment::where('user_id', Auth::user()->id)->where('id', $payment_id);
        if ($payment->doesntExist())
            abort(404, "The Purchase doesn't exist.");

        $character = $payment->character();
        if ($character->doesntExist())
            abort(404, "The character doesn't exist.");

        $training = $character->latestTraining();
        if ($training->exists() && !$training->done)
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

        $character = $payment->character();
        if ($character->doesntExist())
            abort(404, "The Character doesn't exist.");

        $training = $character->latestTraining();
        if ($training->exists() && !$training->done)
        {
            $view = 'farming.training';
            $data = [
                'character' => $character,
                'training' => $training,
                'end_time' => (new DateTime($training->created_at, new DateTimeZone('UTC')))->add(new DateInterval("PT{$training->session->max_hours}H"))
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
