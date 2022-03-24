<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The User Wallet model.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property string $wallet     A user wallet.
 * @property int    $user_id    The FK to the wallet owner.
 * @property Carbon $created_at When the user wallet was added.
 * @property Carbon $updated_at When the user wallet was last updated.
 */
class UserWallet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_wallet';
}
