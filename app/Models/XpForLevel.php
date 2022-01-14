<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * The XP for level model.
 *
 * @property int    $id                The PK that identifies the instance.
 * @property int    $division          The Character's division.
 * @property int    $level             The Character's current level.
 * @property int    $xp_for_next_level The xp needed to advance to $level + 1
 *                                     (if 0 then $level is the maximum level).
 * @property string $created_at        When the xp for level was added.
 * @property string $updated_at        When the xp for level was last updated.
 */
class XpForLevel extends Model
{
    private const GOLD_DIVISION = 1,
                  SILVER_DIVISION = 2,
                  BRONZE_DIVISION = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected string $table = 'xp_for_level';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected array $fillable = [
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

    /**
     * Get the xp for the next level for the gold division.
     *
     * @param int $division The division used in the where clause.
     *
     * @return int[] An array with the xp for next level for every level (key)
     *               associated with the gold division.
     */
    public function gold(): array
    {
        return $this->where('division', self::GOLD_DIVISION)->get()->pluck('xp_for_next_level', 'level');
    }

    /**
     * Get the xp for the next level for the silver division.
     *
     * @param int $division The division used in the where clause.
     *
     * @return int[] An array with the xp for next level for every level (key)
     *               associated with the silver division.
     */
    public function silver(): array
    {
        return $this->where('division', self::SILVER_DIVISION)->get()->pluck('xp_for_next_level', 'level');
    }

    /**
     * Get the xp for the next level for the bronze division.
     *
     * @param int $division The division used in the where clause.
     *
     * @return int[] An array with the xp for next level for every level (key)
     *               associated with the bronze division.
     */
    public function bronze(): array
    {
        return $this->where('division', self::BRONZE_DIVISION)->get()->pluck('xp_for_next_level', 'level');
    }

    /**
     * Get the xp for the next level for the specified division.
     *
     * @param int $division The division used in the where clause.
     *
     * @return int[] An array with the xp for next level for every level (key)
     *               associated with the specified division.
     */
    public function byDivision(int $division): array
    {
        return $this->where('division', $division)->get()->pluck('xp_for_next_level', 'level');
    }
}
