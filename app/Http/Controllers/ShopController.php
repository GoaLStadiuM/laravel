<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BaseCharacter;
use App\Models\Character;
use App\Models\Division;
use App\Models\NftPayment;
use App\Models\Product;
use App\Traits\GoalToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    use GoalToken;

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
        $base_characters = BaseCharacter::get()->pluck('probability', 'id')->toArray();
        $characters = Auth::user()->charactersByDivision($product->division);

        if ($characters->count() === count($base_characters) || $characters->count() > count($base_characters))
            abort(403, 'You already have the maximum number of characters for this division.');

        $nft_payment = new NftPayment;
        $nft_payment->user_id = Auth::user()->id;
        $nft_payment->status_id = 1;
        $nft_payment->product_id = $product->id;
        $nft_payment->price_in_goal = $this->getPriceInGoal($product->price);
        $nft_payment->tx_hash = $request->input('tx_hash'); // TODO IMPORTANT! setup task scheduling to validate txs
        $nft_payment->save();

        $base_id = $this->lottery($base_characters);

        // check if one of the user's owned characters already have the base_id
        if ($characters->count() > 0)
        {
            $owned_ids = $characters->join('base_character', 'character.base_id', '=', 'base_character.id')
                                    ->get()
                                    ->pluck('base_character.probability', 'base_character.id')
                                    ->toArray();

            while (in_array($base_id, $owned_ids))
            {
                unset($base_characters[$base_id]);
                $base_id = $this->lottery($base_characters);
            }
        }

        // character starting stats
        $stats = (new Division($product->division))->getStartingStats();

        $character = new Character;
        $character->user_id = Auth::user()->id;
        $character->base_id = $base_id;
        $character->payment_id = $nft_payment->id;
        $character->division = $product->division;
        $character->level = $product->level;
        $character->strength = random_int(intval($stats * .48), intval($stats * .52));
        $character->accuracy = $stats - $character->strength;
        $character->save();

        return response()->json([
            'ok' => true,
            'characterIndex' => $base_id - 1
        ], JsonResponse::HTTP_CREATED);
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

/* TODO: move this to user account tools
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
*/
}
