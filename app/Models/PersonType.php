<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Person Type model.
 *
 * @property int    $id         The PK that identifies the instance.
 */
class PersonType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person_type';
}
