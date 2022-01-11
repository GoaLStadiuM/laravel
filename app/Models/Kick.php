<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kick extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kick';

    /**
     * Get the character that owns the kick.
     */
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
