<?php

require __DIR__ . '/auth.php';
require __DIR__ . '/www.php';
require __DIR__ . '/play.php';



use App\Models\BaseCharacter;
use App\Models\Character;
use App\Models\NftPayment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

function getBaseId(array $base_characters, HasMany $characters): int
{
    $base_id = lottery($base_characters);

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
            $base_id = lottery($base_characters);
        }
    }

    return $base_id;
}

function lottery(array $items): int
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

//tmp routes
Route::middleware('admin')->group(function ()
{
    Route::get('/test', function() {

        $array = [
            'lauramillanousa@gmail.com' => 60,
            'drumer702@gmail.com' => 150,
            'masmundocripto@gmail.com' => 300,
            'blockchainexplica@gmail.com' => 120
        ];

        // create characters for the above youtubers
        $base_characters = BaseCharacter::lotteryArray();

        foreach ($array as $email => $price)
        {
            $user = User::where('email', $email)->first();
            $product = Product::where('price', $price)->firstOrFail();
            echo "found product where price = $price<br>\n";
            //continue;
            $characters = $user->charactersByDivision($product->division);

            if ($characters->count() === count($base_characters) || $characters->count() > count($base_characters))
                abort(403, 'You already have the maximum number of characters for this division.');

            $base_id = getBaseId($base_characters, $characters);

            Character::create(
                $base_id,
                NftPayment::create(
                    $product->id,
                    0,
                    "$user->id purchased at " . time() . 'using busd balance',
                    $user->id
                ),
                $product,
                $user->id
            );
        }

    });
});
