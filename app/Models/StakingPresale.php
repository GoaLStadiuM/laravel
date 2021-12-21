<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StakingPresale extends Model
{
    protected $table = 'stakings';
    protected $fillable = [
       'user_id',
       'tokens_to_stake',
       'time',
       'wallet',
       'tokenpayment_id'
    ];
}
