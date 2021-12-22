<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseCharacter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'base_character';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'probability',
        'video_url',
        'img_url'
    ];

    /**
     * Get the characters for the base_character.
     */
    public function characters()
    {
        return $this->hasMany(Character::class, 'base_id');
    }
}
