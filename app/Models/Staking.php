<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staking extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
       'tokens_to_stake',
       'time',
       'wallet',
       'tokenpayment_id'
    ];
}
