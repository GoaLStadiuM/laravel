<?php

namespace App\Http\Controllers;

use App\Models\BaseCharacter;
use App\Models\Character;
use App\Models\NftPayment;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    private const DIVISION_1 = 1,
                  DIVISION_2 = 2,
                  DIVISION_3 = 3,
                  DIV1_STARTING_STATS = 95,
                  DIV2_STARTING_STATS = 76,
                  DIV3_STARTING_STATS = 57,
                  CONTRACT = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204',
                  PRICE_API = 'https://api.pancakeswap.info/api/v2/tokens/';

    public function shop()
    {
        return view('penalties.shop', [
            'products' => Product::get()->groupBy('division')
        ]);
    }

    public function purchase(Request $request): JsonResponse
    {
        if (!$request->filled('product_id') || !$request->filled('tx_hash'))
            abort(404, 'Missing params.');

        $product = Product::findOrFail($request->input('product_id'));
        $base_id = $this->lottery(BaseCharacter::get()->pluck('probability', 'id')->toArray());

        // TODO IMPORTANT! setup task scheduling to validate txs

        $nft_payment = new NftPayment;
        $nft_payment->user_id = Auth::user()->id;
        $nft_payment->status_id = 1;
        $nft_payment->product_id = $product->id;
        $nft_payment->price_in_goal = $this->getPriceInGoal($product->price);
        $nft_payment->tx_hash = $request->input('tx_hash');
        $nft_payment->save();

        $this->createCharacter($nft_payment, $base_id);

        return response()->json([
            'ok' => true,
            'characterIndex' => $base_id - 1
        ]);
    }

    private function lottery(array $items): int
    {
        $max = 0;
        foreach ($items as $key => $value)
        {
            $max += $value;
            $items[$key] = $max;
        }

        $random = random_int(1, $max);

        foreach ($items as $item => $max)
        {
            if ($random <= $max)
                return $item;
        }

        abort(500, 'Please, contact support.');
    }

    private function createCharacter(NftPayment $nft_payment, int $base_id): void
    {
        $character = new Character;
        $character->user_id = Auth::user()->id;
        $character->base_id = $base_id;
        $character->payment_id = $nft_payment->id;
        $character->division = $nft_payment->product->division;
        $character->level = $nft_payment->product->level;

        // character starting stats
        switch ($character->division)
        {
            case self::DIVISION_1: $stats = self::DIV1_STARTING_STATS; break;
            case self::DIVISION_2: $stats = self::DIV2_STARTING_STATS; break;
            case self::DIVISION_3: $stats = self::DIV3_STARTING_STATS; break;
            default: abort('404', 'Unknown error. Please, contact support.');
        }

        $character->strength = random_int(($stats * .48), ($stats * .52));
        $character->accuracy = $stats - $character->strength;
        $character->save();
    }

    private function getPriceInGoal(int $price)
    {
        return $price / $this->getJsonObject(self::PRICE_API . self::CONTRACT)->data->price;
    }

    private function getJsonObject(string $url)
    {
        return json_decode(file_get_contents($url));
    }

/*
    private function validateTx(string $txHash, string $address): bool
    {
        $valid = false;

        foreach ($this->getTransactionList($address)->result as $tx)
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


    const BSCSCAN_API_KEY = 'C3J2T5UV3WKW2B54HUKKS61JIVV7B6TBBX',
          BNB_WALLET = '0x55b42BbB7CC8C531bd4fe42C5067de487Cde45CA',
          SHOP_WALLET = '0x4e68EBbB3cf4e107315996a960e2437301563859',
          TOKEN_PRICE_PRIVATE = .04,
          TOKEN_PRICE_PUBLIC = .06,
          WEI_VALUE = 1000000000000000000;

    private stdClass $currentTx;

    public function manualHash(Request $request)
    {
        if (Payment::where('txHash', $request->txHash)->exists() || Tokenpayment::where('txHash', $request->txHash)->exists())
            abort(403, 'A purchase with that txHash already exists.');

        if (!$this->validateTx($request->txHash))
            abort(403, 'The transaction hash is not valid.');

        $tx = $this->currentTx;

        if (date('Y', $tx->timeStamp) !== '2021' || date('m', $tx->timeStamp) !== '11')
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
*/
}
