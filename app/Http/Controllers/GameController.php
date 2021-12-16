<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Tokenpayment;
use App\Models\Tokenproduct;
use App\Models\Presale;
use App\Models\Staking;
use App\Models\Setting;
use App\Models\Training;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;
use DateTimeZone;
use DateTime;
use DateInterval;

class ShopController extends Controller
{
    const BSCSCAN_API_KEY = 'C3J2T5UV3WKW2B54HUKKS61JIVV7B6TBBX', // TODO move to config
          WALLET_BNB = '0x55b42BbB7CC8C531bd4fe42C5067de487Cde45CA', // todo move to config
          TOKEN_PRICE_PRIVATE = .04,
          TOKEN_PRICE_PUBLIC = .06,
          WEI_VALUE = 1000000000000000000;

    private object $currentTx;

    public function claim(int $training_id)
    {
        $training = Training::where('user_id', Auth::user()->id)->where('id', $training_id)->where('done', false);
        if ($training->doesntExist())
            abort(404, "Training doesn't exist or is already completed.");

        $training = $training->first();
        $gameConfig = config('game');
        $maxHours = $gameConfig['MAX_TRAINING_HOURS'];
        $timezone = new DateTimeZone('UTC');
        $start = (new DateTime($training->endTime, $timezone))->sub(new DateInterval("PT{$maxHours}H"));
        $now = new DateTime(null, $timezone);

        $diff = $start->diff($now);
        if (!is_numeric($diff->h))
            abort(403, 'Unknown error. Please, contact support.');

        if (intval($diff->y) > 0 || intval($diff->m) > 0 || intval($diff->d) > 0 || intval($diff->h) >= $maxHours)
        {
            $hours = $maxHours; // int(x)
        }

        else
        {
            $hours = intval($diff->h);
            $training->endTime = $now;
        }

        $training->done = true;
        $training->save();

        if ($hours > 0)
        {
            // Stats Reward
            $pip = $gameConfig['PLAYER_INCREASE_PERCENTAGE'];
            $player = Player::where('user_id', Auth::user()->id)->where('id', $training->player_id)->first();
            $player->strengh += ($player->strengh * $pip) * $hours;
            $player->accuracy += ($player->accuracy * $pip) * $hours;
            $player->save();

            // Goal Reward
            $payment = Payment::where('user_id', Auth::user()->id)->where('player_id', $player->id)->first();
            $user = Auth::user();
            $user->goal += ((($payment->product->price * $gameConfig['PLAYER_REWARD_PERCENTAGE']) * $hours) / $gameConfig['GOAL_PRICE_IN_BUSD']) * .7;
            $user->save();
        }

        return redirect()->route('farming');
    }

    public function selectTraining(int $player_id, int $training_type, int $payment_id)
    {
        if (Training::where('user_id', Auth::user()->id)->where('player_id', $player_id)->where('done', false)->exists())
            abort(403, 'A training session is already in progress.');

        $player = Player::where('user_id', Auth::user()->id)->where('id', $player_id);
        if ($player->doesntExist())
            abort(404, "The player doesn't exist.");

        if (Payment::where('user_id', Auth::user()->id)->where('id', $payment_id)->doesntExist())
            abort(404, "The Purchase doesn't exist.");

        $player = $player->first();
        $gameConfig = config('game');
        $maxHours = $gameConfig['MAX_TRAINING_HOURS'];

        $trainingTypes = [
            $gameConfig['TRAINING_TYPE_HEAD'],
            $gameConfig['TRAINING_TYPE_SHOULDERS'],
            $gameConfig['TRAINING_TYPE_KNEES'],
            $gameConfig['TRAINING_TYPE_FEET']
        ];
        if (!in_array($training_type, $trainingTypes))
            abort(403, 'The training type is not valid.');

        $training = new Training;
        $training->user_id = Auth::user()->id;
        $training->training_type = $training_type;
        $training->player_id = $player_id;
        $training->endTime = (new DateTime(null, new DateTimeZone('UTC')))->add(new DateInterval("PT{$maxHours}H"));
        $training->done = false;
        $training->save();

        return redirect()->route('stats', $payment_id);
    }

    public function stats($payment_id)
    {
        $payment = Payment::where('user_id', Auth::user()->id)->where('id', $payment_id);
        if ($payment->doesntExist())
            abort(404, "The Purchase doesn't exist.");

        $payment = $payment->first();
        $gameConfig = config('game');
        $training = Training::where('user_id', Auth::user()->id)->where('player_id', $payment->player_id)->where('done', false);

        $player = Player::where('user_id', Auth::user()->id)->where('id', $payment->player_id);
        if ($player->doesntExist())
        {
            $player = new Player;
            $player->user_id = Auth::user()->id;
            $player->character_id = $payment->character_id;

            // player starting stats
            switch ($payment->product->division)
            {
                case 1:
                    $player->strengh = rand($gameConfig['DIV1_STARTING_STATS'] * .48, $gameConfig['DIV1_STARTING_STATS'] * .52);
                    $player->accuracy = $gameConfig['DIV1_STARTING_STATS'] - $player->strengh;
                    break;
                case 2:
                    $player->strengh = rand($gameConfig['DIV2_STARTING_STATS'] * .48, $gameConfig['DIV2_STARTING_STATS'] * .52);
                    $player->accuracy = $gameConfig['DIV2_STARTING_STATS'] - $player->strengh;
                    break;
                case 3:
                    $player->strengh = rand($gameConfig['DIV3_STARTING_STATS'] * .48, $gameConfig['DIV3_STARTING_STATS'] * .52);
                    $player->accuracy = $gameConfig['DIV3_STARTING_STATS'] - $player->strengh;
                    break;
                default: abort('404', 'Unknown error. Please, contact support.');
            }

            $player->save();

            $payment->player_id = $player->id;
            $payment->save();
        }

        else if ($training->exists())
        {
            $player = $player->first();
            $training = $training->first();
            $maxHours = $gameConfig['MAX_TRAINING_HOURS'];

            return view('farming.training', compact('player', 'training', 'maxHours'));
        }

        else
        {
            $player = $player->first();
        }

        $trainingTypes = [
            'Head Training' => $gameConfig['TRAINING_TYPE_HEAD'],
            'Shoulders Training' => $gameConfig['TRAINING_TYPE_SHOULDERS'],
            'Knees Training' => $gameConfig['TRAINING_TYPE_KNEES'],
            'Feet Training' => $gameConfig['TRAINING_TYPE_FEET']
        ];

        return view('farming.stats', compact('player', 'payment', 'trainingTypes'));
    }

    public function farming()
    {
        $payments = Payment::where('user_id', Auth::user()->id)->where('character_id', '!=', null)->get();
        return view('farming.index', compact('payments'));
    }
}
