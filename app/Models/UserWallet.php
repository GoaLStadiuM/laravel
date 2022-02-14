<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The User Wallet model.
 *
 * @property int    $id         The PK that identifies the instance.
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
