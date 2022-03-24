<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The Status model.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property string $code       The status code.
 * @property Carbon $created_at When the status was created.
 * @property Carbon $updated_at When the status was last updated.
 */
class Status extends Model
{
    public const OK = 1;

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
