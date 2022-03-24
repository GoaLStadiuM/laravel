<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The User Referrer model.
 *
 * @property int    $id          The PK that identifies the instance.
 * @property int    $referrer_id The FK to the user who referred another user.
 * @property int    $user_id     The FK to the user who was referred.
 * @property Carbon $created_at  When the user was referred.
 * @property Carbon $updated_at  When the user was referred.
 */
class UserReferrer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_referrer';
}
