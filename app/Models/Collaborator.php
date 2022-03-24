<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The Collaborator model.
 *
 * @property int    $id           The PK that identifies the instance.
 * @property string $title        The collaborator designation.
 * @property int    $amount       The amount in BUSD to spend in the shop.
 * @property string $country_code The collaborator country code (ISO 3166-1 alpha-2 code).
 * @property int    $entity_id    The FK to the entity represented by the collaborator.
 * @property Carbon $created_at   When the collaborator joined the team.
 * @property Carbon $updated_at   When the collaborator was last updated.
 */
class Collaborator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collaborator';
}
