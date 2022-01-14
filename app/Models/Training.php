<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * The Training model.
 *
 * @property int    $id           The PK that identifies the instance.
 * @property int    $character_id The foreign key to the trainee.
 * @property int    $session_id   The foreign key to the training session.
 * @property bool   $stopped      If the training is currently stopped or in progress.
 * @property bool   $done         If the training has ended or not.
 * @property string $created_at   When the training started.
 * @property string $updated_at   When the training was last updated.
 */
class Training extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected string $table = 'training';

    /**
     * Get the character that owns the training.
     *
     * @return BelongsTo
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get the training session that owns the training.
     *
     * @return BelongsTo
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class, 'session_id');
    }
}
