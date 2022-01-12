<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     * Get the characters for the kicks per divivion.
     */
    public function characters()
    {
        return $this->hasMany(Characters::class, 'division', 'division');
    }
}
