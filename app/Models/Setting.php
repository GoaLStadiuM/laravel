<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Setting model.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property string $code       The setting code.
 * @property string $value      The setting value.
 * @property string $created_at When the setting was created.
 * @property string $updated_at When the setting was last updated.
 */
class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'value',
        'created_at',
        'updated_at'
    ];
}
