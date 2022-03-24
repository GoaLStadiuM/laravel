<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The Member model.
 *
 * @property int    $id           The PK that identifies the instance.
 * @property string $title        The member designation.
 * @property int    $share        A share from the tokenomics.
 * @property string $wallet       The wallet to send the monthly payment (from share).
 * @property int    $entity_id    The FK to the entity represented by the member.
 * @property Carbon $created_at   When the member joined the team.
 * @property Carbon $updated_at   When the member was last updated.
 */
class Member extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member';
}
