<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * The Training Session model.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property string $name       The name of the training session.
 * @property int    $max_hours  The duration of the training session.
 * @property Carbon $created_at When this type of training session was created.
 * @property Carbon $updated_at When this type of training session was last updated.
 */
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
     * Get all the trainings of this type.
     *
     * @return HasMany
     */
    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class, 'id', 'session_id');
    }
}
