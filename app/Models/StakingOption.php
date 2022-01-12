<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StakingOption extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'staking_option';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'vesting_period',
        'bonus_percentage',
        'created_at',
        'updated_at'
    ];
}
