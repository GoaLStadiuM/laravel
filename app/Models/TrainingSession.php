<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training_session';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'max_hours',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the trainings for the training session.
     */
    public function trainings()
    {
        return $this->hasMany(Training::class, 'id', 'session_id');
    }
}
