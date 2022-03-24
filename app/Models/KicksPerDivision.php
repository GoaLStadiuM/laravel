<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * The Kicks per division model.
 *
 * @property int    $division   The PK that identifies the instance.
 * @property int    $kicks      The number of kicks characters in this division
 *                              can perform (for every window).
 * @property Carbon $created_at When the kicks per division was created.
 * @property Carbon $updated_at When the Kicks per division was last updated.
 */
class KicksPerDivision extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kicks_per_division';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'division';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'kicks',
        'created_at',
        'updated_at'
    ];

    /**
     * Get all the characters that belong to this divivion.
     *
     * @return HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class, 'division', 'division');
    }
}
