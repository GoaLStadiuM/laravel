<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Influencer model.
 *
 * @property int    $id         The PK that identifies the instance.
 */
class Influencer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'influencer';
}
