<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * The NFT Payment model.
 *
 * @property int    $id            The PK that identifies the instance.
 * @property int    $user_id       The FK to the buyer.
 * @property int    $status_id     The FK to the status.
 * @property int    $product_id    The FK to the purchased item.
 * @property string $price_in_goal The item price at the time of purchase.
 * @property string $tx_hash       The transaction hash.
 * @property string $created_at    When the purchase took place.
 * @property string $updated_at    When the purchase was last updated.
 */
class NftPayment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nft_payment';

    /**
     * Get the buyer.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the purchase status.
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the purchased product.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the purchased character.
     *
     * @return HasOne
     */
    public function character(): HasOne
    {
        return $this->hasOne(Character::class, 'payment_id');
    }

    /**
     * Create a new entity of NFT Payment.
     *
     * @return int The PK that identifies the instance.
     */
    public static function create(int $product_id, string $price_in_goal, string $tx_hash, $user_id = null): int
    {
        $nft_payment = new NftPayment;
        $nft_payment->user_id = $user_id ?? Auth::user()->id;
        $nft_payment->status_id = Status::OK; // TODO
        $nft_payment->product_id = $product_id;
        $nft_payment->price_in_goal = $price_in_goal;
        $nft_payment->tx_hash = $tx_hash; // TODO IMPORTANT! setup task scheduling to validate txs
        $nft_payment->save();

        return $nft_payment->id;
    }
}
