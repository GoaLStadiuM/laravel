<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Share Sent model.
 *
 * @property int    $id         The PK that identifies the instance.
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
