<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateTimeZone;

class Character extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character';

    /**
     * Get the user that owns the character.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the base character that owns the character.
     */
    public function base()
    {
        return $this->belongsTo(BaseCharacter::class, 'base_id');
    }

    /**
     * Get the nft payment that owns the character.
     */
    public function payment()
    {
        return $this->belongsTo(NftPayment::class, 'payment_id');
    }

    /**
     * Get the kicks per division that owns the character.
     */
    public function kicksPerDivision()
    {
        return $this->belongsTo(KicksPerDivision::class, 'division', 'division');
    }

    /**
     * Get the xp for level that owns the character.
     */
    public function xpForLevel()
    {
        return $this->belongsTo(XpForLevel::class, 'division', 'division');
    }

    /**
     * Get the trainings for the character.
     */
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    /**
     * Get the character's most recent training.
     */
    public function latestTraining()
    {
        return $this->hasOne(Training::class)->latestOfMany();
    }

    /**
     * Get the kicks for the character.
     */
    public function kicks()
    {
        return $this->hasMany(Kick::class);
    }

    /**
     * Get the number of kicks per window for the character.
     */
    public function kicksPerWindow(): int
    {
        return $this->kicksPerDivision()->first()->kicks;
    }

    /**
     * Get the number of current window kicks for the character.
     */
    public function currentKicks(array $window): int
    {
        return $this->hasMany(Kick::class)->whereNotNull('reward')->whereBetween('created_at', $window)->count();
    }

    /**
     * Detemines whether the character can kick or not.
     */
    public function canKick(array $window): bool
    {
        return $this->kicksPerWindow() > $this->currentKicks($window);
    }

    /**
     * Get the character's most recent kick.
     */
    public function latestKick(string $ago = '30 minutes ago')
    {
        $latest = $this->hasOne(Kick::class)->latestOfMany()->whereNull('reward');

        if (empty($ago))
            return $latest;

        return $latest->where('created_at', '>', new DateTime($ago, new DateTimeZone('UTC') ));
    }
}
