<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * The Character Authorized model.
 *
 * @property int    $id            The PK that identifies the instance.
 * @property int    $authorized_id The FK to the authorized user.
 * @property int    $character_id  The FK to the character that's been authorized.
 * @property int    $percentage    What the user gets for playing.
 * @property Carbon $created_at    When the character was authorized to the user.
 * @property Carbon $updated_at    When the character was authorized to the user.
 */
class CharacterAuthorized extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_authorized';

    /**
     * The user to which the character has been granted playing rights.
     *
     * @return BelongsTo
     */
    public function grantee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The character that has been granted.
     *
     * @return BelongsTo
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
