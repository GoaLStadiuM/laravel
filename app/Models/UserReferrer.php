<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The User Referrer model.
 *
 * @property int    $id         The PK that identifies the instance.
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
