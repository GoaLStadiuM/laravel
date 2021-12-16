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

    private Object $currentTx;

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


    public function purchases()
    {
        $presale = Presale::where('user_id', Auth::user()->id)->get();
        $stake = Staking::where('user_id', Auth::user()->id)->get();
        $payments = Payment::where('user_id', Auth::user()->id)->where('character_id', '!=', null)->get();
        $tokens = Tokenpayment::where('user_id', Auth::user()->id)->get();
        return view('shop.purchases', compact('payments', 'tokens', 'presale', 'stake'));
    }

    public function manualHash(Request $request)
    {
        if ($this->checkTx($request->txHash))
            abort(403, 'A purchase with that txHash already exists.');

        if (!$this->validateTx($request->txHash))
            abort(403, 'The transaction hash is not valid.');

        $tx = $this->currentTx;

        if ($this->checkDate(date('Y', $tx->timeStamp), date('m', $tx->timeStamp)))
            abort(403, 'Transaction date mismatch (1). Please, contact support.');

        $amountPaid = $tx->value / self::WEI_VALUE;

        // 11, 14, 16, 18, 19 and 21
        switch (date('d', $tx->timeStamp))
        {
            case '11': $this->createNftPayment($tx->hash, $amountPaid, $this->validateNfts(622 * $amountPaid, .5)); break;
            case '14': $this->createNftPayment($tx->hash, $amountPaid, $this->validateNfts(646 * $amountPaid, .75)); break;
            case '16': $this->createNftPayment($tx->hash, $amountPaid, $this->validateNfts(582 * $amountPaid, .85)); break;
            case '18': $this->createNftPayment($tx->hash, $amountPaid, $this->validateNfts(535 * $amountPaid, .9)); break;
            case '19':
            case '21': $this->createTokenPayment($tx->hash, $amountPaid, $this->validateTokens($tx)); break;
            default: abort(403, 'Transaction date mismatch (2). Please, contact support.');
        }

        return redirect()->route('purchases');
    }

    private function createNftPayment(string $txHash, string $value, int $productId): void
    {
        Payment::create([
            'user_id' => Auth::user()->id,
            'txHash' => $txHash,
            'amount' => $value,
            'status_id' => 1,
            'product_id' => $productId,
            'amount_in_payment_coin' => $value,
            'payment_coin' => 'BNB'
        ]);
    }

    private function createTokenPayment(string $txHash, string $value, int $goals): void
    {
        Tokenpayment::create([
            'user_id' => Auth::user()->id,
            'txHash' => $txHash,
            'amount' => $value,
            'status_id' => 1,
            'product_id' => 1,
            'amount_in_payment_coin' => $value,
            'payment_coin' => 'BNB',
            'goal_tokens' => $goals
        ]);
    }

    public function sentStakingPresale(Request $request)
    {
        $tp = $this->checkTokenPayment($request->id);

        $stake = new Staking;
        $stake->wallet = $this->validateTokenTransaction($tp->txHash, $tp->goal_tokens);
        if ($stake->wallet === null)
            abort(404, 'Unknown error. Please contact support.');

        $stake->tokens_to_stake = $tp->goal_tokens * .25;
        $stake->user_id = Auth::user()->id;
        $stake->time = $request->time;
        $stake->tokenpayment_id = $tp->id;
        $stake->save();

        return redirect()->route('purchases');
    }

    public function requestToken(int $id)
    {
        $tp = $this->checkTokenPayment($id);

        $presale = new Presale;
        $presale->wallet = $this->validateTokenTransaction($tp->txHash, $tp->goal_tokens);
        if ($stake->wallet === null)
            abort(404, 'Unknown error. Please contact support.');

        $presale->amount = $tp->goal_tokens * .25;
        $presale->user_id = Auth::user()->id;
        $presale->status = "Request, successfully received. Waiting for wallet deploy";
        $presale->tokenpayment_id = $id;
        $presale->save();

        return redirect()->route('purchases');
    }

    private function checkTokenPayment(int $id): TokenPayment
    {
        $tp = Tokenpayment::where('user_id', Auth::user()->id)->where('id', $id);
        if ($tp->doesntExist())
            abort(404, "The purchase doesn't exist.");

        $tp = $tp->first();

        if (Presale::where('tokenpayment_id', $tp->id)->exists())
            abort(403, 'Withdrawal already in process.');

        if (Staking::where('tokenpayment_id', $tp->id)->exists())
            abort(403, 'Staking already in process.');

        return $tp;
    }

    private function validateTokenTransaction(string $txHash, int $goals): string
    {
        if (!$this->validateTx($txHash))
            abort(403, 'tx hash not valid');

        $tx = $this->currentTx;

        if ($this->checkDate(date('Y', $tx->timeStamp), date('m', $tx->timeStamp)))
            abort(403, 'Transaction date mismatch (1). Please, contact support.');

        $this->validateTokens($tx, $goals);

        return $tx->from;
    }

    private function validateTokens(Object $tx, int $goals = 0): ?int
    {
        // Amount validation
        $estimatedAmount = 585 * ($tx->value / self::WEI_VALUE);
        $estimatedGoals = 0;

        // days 19 and 21 (nov 2021)
        switch (date('d', $tx->timeStamp))
        {
            case '19': $estimatedGoals = $estimatedAmount / self::TOKEN_PRICE_PRIVATE; break;
            case '21': $estimatedGoals = $estimatedAmount / self::TOKEN_PRICE_PUBLIC; break;
            default: abort(403, 'Transaction date mismatch (2). Please, contact support.');
        }

        if ($goals === 0)
            return $estimatedGoals;

        if ($goals > $estimatedGoals)
            abort(403, 'Amount mismatch. Please, contact support.');
    }

    private function checkNftPayment(array $param): Payment
    {
        $np = Payment::where('user_id', Auth::user()->id)->where(key($param[0]), $param[0]);
        if ($np->doesntExist())
            abort(404, "The purchase doesn't exist.");

        return $np->first();
    }

    private function validateNftTransaction(string $txHash)
    {
        // todo: ?
    }

    private function validateNfts(float $price, float $discount = 1): int
    {
        $gameConfig = config('game');
        $prices = [
            $gameConfig['NFT_DIV1_LVL1'] * $discount,
            $gameConfig['NFT_DIV2_LVL1'] * $discount,
            $gameConfig['NFT_DIV3_LVL1'] * $discount,
            $gameConfig['NFT_DIV1_LVL2'] * $discount,
            $gameConfig['NFT_DIV2_LVL2'] * $discount,
            $gameConfig['NFT_DIV3_LVL2'] * $discount,
            $gameConfig['NFT_DIV1_LVL3'] * $discount,
            $gameConfig['NFT_DIV2_LVL3'] * $discount,
            $gameConfig['NFT_DIV3_LVL3'] * $discount,
            $gameConfig['NFT_DIV1_LVL4'] * $discount,
            $gameConfig['NFT_DIV2_LVL4'] * $discount,
            $gameConfig['NFT_DIV3_LVL4'] * $discount,
            $gameConfig['NFT_DIV1_LVL5'] * $discount,
            $gameConfig['NFT_DIV2_LVL5'] * $discount,
            $gameConfig['NFT_DIV3_LVL5'] * $discount,
            $gameConfig['NFT_DIV2_LVL6'] * $discount,
            $gameConfig['NFT_DIV3_LVL6'] * $discount,
            $gameConfig['NFT_DIV2_LVL7'] * $discount,
            $gameConfig['NFT_DIV3_LVL7'] * $discount,
            $gameConfig['NFT_DIV2_LVL8'] * $discount,
            $gameConfig['NFT_DIV3_LVL8'] * $discount,
            $gameConfig['NFT_DIV3_LVL9'] * $discount,
            $gameConfig['NFT_DIV3_LVL10'] * $discount
        ];
        $distances = array_map(
            static function (int $range) use ($price): int {
                return abs($price - $range);
            },
            $prices
        );

        $index = key($prices[array_search(min($distances), $distances)]);

        if ($prices[$index] - $price > $price * .1)
            abort(403, 'The amount paid for the character is lower than 90% the character price.');

        return $index + 1;
    }

    private function checkTx(string $txHash): bool
    {
        return Payment::where('txHash', $txHash)->exists() || Tokenpayment::where('txHash', $txHash)->exists();
    }

    private function validateTx(string $txHash): bool
    {/*
        if ($this->currentTx !== null)
            return true;*/

        $valid = false;

        foreach ($this->getTransactionList(self::WALLET_BNB)->result as $tx)
        {
            if ($txHash !== $tx->hash)
                continue;

            $this->currentTx = $tx;
            $valid = true;
        }

        return $valid;
    }

    private function getTransactionList(string $address): Object
    {
        // todo cache for a few seconds
        $response = file_get_contents("https://api.bscscan.com/api?module=account&action=txlist&address=$address&apikey=" . self::BSCSCAN_API_KEY);
        return json_decode($response);
    }

    private function checkDate(string $y, string $m): bool
    {
        // date: 2021 nov
        return $y !== '2021' || $m !== '11';
    }

    // TODO delete
    public function payerPost(Request $request)
    {
        $elm = Presale::find($request->ide);
        if($elm == null)
            abort(404);


        $elm->paid = true;
        $elm->save();

        return "ok";
    }

    // TODO delete
    public function payer()
    {
        $curl = curl_init();
        $response = file_get_contents("https://api.bscscan.com/api?module=account&action=txlist&address=0x55b42BbB7CC8C531bd4fe42C5067de487Cde45CA&apikey=C3J2T5UV3WKW2B54HUKKS61JIVV7B6TBBX");
        $results = json_decode($response);

        $elms = Presale::where('paid', 0)->get();

        return view('payer', compact('elms'));
    }
}
