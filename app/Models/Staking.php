<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'staking';

    /**
     * Get the user that owns the staking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the staking_option that owns the staking.
     */
    public function option()
    {
        return $this->belongsTo(StakingOption::class);
    }
}
