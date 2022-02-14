<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Collaborator model.
 *
 * @property int    $id         The PK that identifies the instance.
 */
class Collaborator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collaborator';
}
