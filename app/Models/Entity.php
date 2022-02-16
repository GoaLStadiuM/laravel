<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents an entity related to the organization.
 *
 * @property int    $id         The PK that identifies the instance.
 */
class Entity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entity';
}
