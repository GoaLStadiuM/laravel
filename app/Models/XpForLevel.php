<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * The XP for level model.
 *
 * @property int    $id                The PK that identifies the instance.
 * @property int    $division          The Character's division.
 * @property int    $level             The Character's current level.
 * @property int    $xp_for_next_level The xp needed to advance to $level + 1
 *                                     (if 0 then $level is the maximum level).
 * @property Carbon $created_at        When the xp for level was added.
 * @property Carbon $updated_at        When the xp for level was last updated.
 */
class XpForLevel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'xp_for_level';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'division',
        'level',
        'xp_for_next_level',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the characters for the xp for level.
     *
     * @return HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class, 'division', 'division');
    }
}
