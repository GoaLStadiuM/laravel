<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Character Authorized model.
 *
 * @property int    $id         The PK that identifies the instance.
 */
class CharacterAuthorized extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_authorized';
}
