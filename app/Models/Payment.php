<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'txHash',
        'amount',
        'status_id',
        'product_id',
        'amount_in_payment_coin',
        'payment_coin'
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
