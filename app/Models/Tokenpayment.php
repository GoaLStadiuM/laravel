<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokenpayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'txHash',
        'amount',
        'status_id',
        'product_id',
        'amount_in_payment_coin',
        'payment_coin',
        'goal_tokens'
    ];
}
