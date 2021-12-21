<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NftPayment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nft_payment';

    /**
     * Get the user that owns the nft_payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status that owns the nft_payment.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the product that owns the nft_payment.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
