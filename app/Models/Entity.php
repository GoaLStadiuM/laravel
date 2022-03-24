<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Represents an entity related to the organization.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property string $name       The entity name.
 * @property string $image_url  The image representing the entity.
 * @property string $note       Observations for the entity.
 * @property bool   $hidden     Whether the entity should be unlisted or not.
 * @property int    $user_id    The FK of the user associated with this entity.
 * @property Carbon $created_at When the entity joined the team.
 * @property Carbon $updated_at When the entity was last updated.
 */
class Entity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entity';
}
