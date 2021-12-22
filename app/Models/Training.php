<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training';

    /**
     * Get the character that owns the training.
     */
    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get the training_session that owns the training.
     */
    public function session()
    {
        return $this->belongsTo(TrainingSession::class, 'id', 'session_id');
    }
}
