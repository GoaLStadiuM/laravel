<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\NftPayment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    private const DIVISION_1 = 1,
                  DIVISION_2 = 2,
                  DIVISION_3 = 3,
                  DIV1_STARTING_STATS = 95,
                  DIV2_STARTING_STATS = 76,
                  DIV3_STARTING_STATS = 57;

    public function penaltiesShopCharacters()
    {
        return view('penalties.shop', [
            'products' => Product::get()->groupBy('division')
        ]);
    } // TODO: shop

    private function createCharacter(NftPayment $nft_payment): void
    {
        $character = new Character;
        $character->user_id = Auth::user()->id;
        $character->base_id = 'calculate which base_character.id'; // todo
        $character->payment_id = $nft_payment->id;
        $character->division = $nft_payment->product->division;
        $character->level = $nft_payment->product->level;

        // character starting stats
        switch ($character->division)
        {
            case DIVISION_1: $stats = self::DIV1_STARTING_STATS; break;
            case DIVISION_2: $stats = self::DIV2_STARTING_STATS; break;
            case DIVISION_3: $stats = self::DIV3_STARTING_STATS; break;
            default: abort('404', 'Unknown error. Please, contact support.');
        }

        $character->strength = rand($stats * .48, $stats * .52);
        $character->accuracy = $stats - $character->strength;
        $character->save();
    }
}
