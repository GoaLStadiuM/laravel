<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
      'character_id',
      'user_id',
      'strengh',
      'accuracy'
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
