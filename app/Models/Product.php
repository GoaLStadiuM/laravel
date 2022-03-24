<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The Product model.
 *
 * @property int    $id          The PK that identifies the instance.
 * @property string $name        The product name.
 * @property string $description The product description.
 * @property int    $division    The product division.
 * @property int    $level       The product level.
 * @property int    $price       The product price.
 * @property string $video_url   The url of the product's video.
 * @property string $img_url     The url of the product's image.
 * @property Carbon $created_at  When the product was added.
 * @property Carbon $updated_at  When the product was last updated.
 */
class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'division',
        'level',
        'price',
        'video_url',
        'img_url',
        'created_at',
        'updated_at'
    ];

    // TODO: missing relationships

    public static function priceFromCharacter(Character $character): string
    {
        return strval(Product::select('price')->where([
            'division' => $character->division,
            'level' => $character->level
        ])->first()->price);
    }
}
