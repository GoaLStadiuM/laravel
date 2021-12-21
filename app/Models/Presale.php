<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presale extends Model
{
    protected $fillable = [
        'wallet',
        'amount',
        'paid',
        'status',
        'user_id',
        'tokenpayment_id'
    ];
}
