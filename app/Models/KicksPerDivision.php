<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * The Kicks per division model.
 *
 * @property int    $division   The PK that identifies the instance.
 * @property int    $kicks      The number of kicks characters in this division
 *                              can perform (for every window).
 * @property string $created_at When the kicks per division was created.
 * @property string $updated_at When the Kicks per division was last updated.
 */
class KicksPerDivision extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected string $table = 'kicks_per_division';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected string $primaryKey = 'division';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected array $fillable = [
        'kicks',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the characters for the kicks per divivion.
     *
     * @return HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Characters::class, 'division', 'division');
    }
}
