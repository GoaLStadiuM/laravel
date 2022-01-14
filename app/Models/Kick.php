<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * The Kick model.
 *
 * @property int    $id           The PK that identifies the instance.
 * @property int    $character_id The foreign key to the kicker.
 * @property bool   $result       Whether the character scored a goal or not.
 * @property float  $reward       The reward for scoring a goal (in GLS).
 * @property string $created_at   When the kick took place.
 * @property string $updated_at   When the kick was last updated.
 */
class Kick extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected string $table = 'kick';

    /**
     * Get the character that owns the kick.
     *
     * @return BelongsTo
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
