<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character';

    /**
     * Get the user that owns the character.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the base_character that owns the character.
     */
    public function base()
    {
        return $this->belongsTo(BaseCharacter::class, 'base_id');
    }

    /**
     * Get the trainings for the character.
     */
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    /**
     * Get the character's most recent training.
     */
    public function latestTraining()
    {
        return $this->hasOne(Training::class)->latestOfMany();
    }
}
