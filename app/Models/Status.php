<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Status model.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property string $code       The status code.
 * @property string $created_at When the status was created.
 * @property string $updated_at When the status was last updated.
 */
class Status extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'created_at',
        'updated_at'
    ];

    // TODO: missing relationships
}
