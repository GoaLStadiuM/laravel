<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XpForLevel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'xp_for_level';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'division',
        'level',
        'xp_for_next_level'
    ];
}
