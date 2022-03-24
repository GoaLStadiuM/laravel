<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The Share Sent model.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property int    $amount     The amount of the total share sent.
 * @property int    $entity_id  The FK to the entity where the amount was sent.
 * @property Carbon $created_at When the share was sent.
 * @property Carbon $updated_at When the share was sent.
 */
class ShareSent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'share_sent';
}
