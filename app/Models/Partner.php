<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The Partner model.
 *
 * @property int    $id          The PK that identifies the instance.
 * @property string $website_url The partner's website url.
 * @property int    $entity_id   The FK to the entity represented by the partner.
 * @property Carbon $created_at  When the partner joined the team.
 * @property Carbon $updated_at  When the partner was last updated.
 */
class Partner extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partner';
}
