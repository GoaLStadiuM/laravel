<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     */
    public function characters() // todo fix composite relationship
    {
        return $this->hasMany(Character::class, 'division', 'division');
    }

    /**
     * Get the xp for the next level for the gold division.
     */
    public function gold()
    {
        return $this->where('division', self::GOLD_DIVISION);
    }

    /**
     * Get the xp for the next level for the silver division.
     */
    public function silver()
    {
        return $this->where('division', self::SILVER_DIVISION);
    }

    /**
     * Get the xp for the next level for the bronze division.
     */
    public function bronze()
    {
        return $this->where('division', self::BRONZE_DIVISION);
    }

    /**
     * Get the xp for the next level for the specified division.
     */
    public function byDivision(int $division)
    {
        return $this->where('division', $division);
    }
}
