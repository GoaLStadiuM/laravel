<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * The Training model.
 *
 * @property int    $id           The PK that identifies the instance.
 * @property int    $character_id The FK to the trainee.
 * @property int    $session_id   The FK to the training session.
 * @property bool   $stopped      If the training is currently stopped or in progress.
 * @property int    $hours        Hours trained.
 * @property bool   $done         If the training has ended or not.
 * @property Carbon $created_at   When the training started.
 * @property Carbon $updated_at   When the training was last updated.
 */
class Training extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'stopped' => 'boolean',
        'done'    => 'boolean'
    ];

    /**
     * Get the trainee.
     *
     * @return BelongsTo
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get the trainee training session.
     *
     * @return BelongsTo
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class, 'session_id');
    }
}
