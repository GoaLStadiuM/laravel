<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BaseCharacter;
use App\Models\Character;
use App\Models\NftPayment;
use App\Models\Product;
use App\Traits\GoalToken;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    use GoalToken;

    public function shop()
    {
        return view('play.penalties.shop', [
            'products' => Product::get()->groupBy('division'),
            'base_characters' => BaseCharacter::get(),
            'characters' => Auth::user()->characters()->groupBy('division')
        ]);
    }

    public function purchase(Request $request): JsonResponse
    {
        if (!$request->filled('product_id') || !$request->filled('tx_hash'))
            abort(404, 'Missing params.');

        $product = Product::findOrFail($request->input('product_id'));
        $base_characters = BaseCharacter::lotteryArray();
        $characters = Auth::user()->charactersByDivision($product->division);
        $characterCount = $characters->count();
        $baseCount = count($base_characters);
        $tx_hash = $request->input('tx_hash'); // TODO come up with a unique string for purchases in busd credit and gls

        if ($characterCount === $baseCount || $characterCount > $baseCount)
            abort(403, 'You already have the maximum number of characters for this division.');

        // TODO: finish this
        if (!str_starts_with($request->input('tx_hash'), '0x') && $this->checkStuff($request->input('tx_hash')))
            $tx_hash = $this->payWithBalance();

        $base_id = $this->getBaseId($base_characters, $characters);

        Character::create(
            $base_id,
            NftPayment::create(
                $product->id,
                $this->getPriceInGoal($product->price), // TODO rename column from price_in_goal to amount_paid
                $tx_hash
            ),
            $product
        );

        return response()->json([
            'ok' => true,
            'characterIndex' => $base_id - 1,
            'division' => $product->division,
            'maxCharacters' => $baseCount - $characterCount === 1
        ], JsonResponse::HTTP_CREATED);
    }

    private function checkStuff(string $stuff): bool
    {
        abort(403, 'Not implemented yet.');
    }

    private function payWithBalance(): string
    {
        abort(403, "You don't have enough balance.");
    }

    private function getBaseId(array $base_characters, HasMany $characters): int
    {
        $base_id = $this->lottery($base_characters);

        // check if the user already has characters in this division
        if ($characters->count() > 0)
        {
            $owned_ids = $characters->join('base_character', 'character.base_id', '=', 'base_character.id')
                                    ->get()
                                    ->pluck('base_character.probability', 'base_character.id')
                                    ->toArray();

            // check if one of the user's owned characters already have the base_id
            while (in_array($base_id, $owned_ids))
            {
                unset($base_characters[$base_id]);
                $base_id = $this->lottery($base_characters);
            }
        }

        return $base_id;
    }

    /**
     * @throws Exception
     */
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
