<?php declare(strict_types=1);

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * The Character model.
 *
 * Based on a soccer player (BaseCharacter).
 *
 * @property int    $id         The PK that identifies the instance.
 * @property int    $user_id    The FK to the owner.
 * @property int    $base_id    The FK to the base character.
 * @property int    $payment_id The FK to the purchase.
 * @property string $name       The character's custom name.
 * @property int    $division   The character's division. Also FK to:
 *                              kicks_per_division and xp_for_level.
 * @property int    $level      The character's level. Also, the FK to:
 *                              xp_for_level.
 * @property string $strength   The character's strength.
 * @property string $accuracy   The character's accuracy.
 * @property int    $xp         The character's experience points.
 * @property string $created_at When the character was purchased.
 * @property string $updated_at When the character was last updated.
 */
class Character extends Model
{
    public const INCREASE_PERCENTAGE = '.00027',
                 REWARD_PERCENTAGE = '.000173';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character';

    /**
     * Get the owner.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the base character.
     *
     * @return BelongsTo
     */
    public function base(): BelongsTo
    {
        return $this->belongsTo(BaseCharacter::class, 'base_id');
    }

    /**
     * Get the character's purchase information.
     *
     * @return BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(NftPayment::class, 'payment_id');
    }

    /**
     * Get the character's starting stats.
     *
     * @return int
     */
    public function startingStats(): int
    {
        return (new Division($this->division))->getStartingStats();
    }

    /**
     * Get the character's starting percentage.
     *
     * @return int
     */
    public function startingPercentage(): int
    {
        return (new Division($this->division))->getStartingPercentage();
    }

    /**
     * Get the character's max stats.
     *
     * @return int
     */
    public function maxStats(): int
    {
        return (new Division($this->division))->getMaxStats();
    }

    /**
     * Get the kicks per division for the character.
     *
     * @return BelongsTo
     */
    public function kicksPerDivision(): BelongsTo
    {
        return $this->belongsTo(KicksPerDivision::class, 'division', 'division');
    }

    /**
     * Get the xp for level for the character.
     *
     * @return array<int, int> An array with the xp for next level for every level (key).
     */
    public function xpForLevel(): array
    {
        return $this->belongsTo(XpForLevel::class, 'division', 'division')->get()->pluck('xp_for_next_level', 'level')->toArray();
    }

    /**
     * Get the character's trainings.
     *
     * @return HasMany
     */
    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class);
    }

    /**
     * Get the character's most recent training.
     *
     * @return HasOne
     */
    public function latestTraining(): HasOne
    {
        return $this->hasOne(Training::class)->latestOfMany();
    }

    /**
     * Get the character's kicks.
     *
     * @return HasMany
     */
    public function kicks(): HasMany
    {
        return $this->hasMany(Kick::class);
    }

    /**
     * Get the number of kicks per window for the character.
     *
     * @return int The number of kicks the character is allowed to perform in
     *             every window. As it is now, this number is determined by
     *             the division of the character.
     */
    public function kicksPerWindow(): int
    {
        return $this->kicksPerDivision()->first()->kicks;
    }

    /**
     * Get the number of current window kicks for the character.
     *
     * @param array $window
     * @return int The number of kicks performed by the character in the
     *             current window. [Reason for excluding where reward is not null.]
     */
    public function currentKicks(array $window): int
    {
        return $this->hasMany(Kick::class)->whereNotNull('reward')->whereBetween('created_at', $window)->count();
    }

    /**
     * Detemines whether the character can kick or not.
     *
     * @param array $window
     * @return bool If the character can kick or not.
     */
    public function canKick(array $window): bool
    {
        return $this->kicksPerWindow() > $this->currentKicks($window);
    }

    /**
     * Get the current kick for the specified window.
     *
     * @param array $window
     * @return HasOne
     */
    public function currentKick(array $window): HasOne
    {
        return $this->hasOne(Kick::class)->whereNull('reward')->whereBetween('created_at', $window);
    }

    /**
     * Get the current kick or create a new one.
     *
     * @param array $cond
     * @param array $stuff
     * @return Kick The instance of the current or new kick.
     */
    public function currentKickOrCreate(array $cond, array $stuff): Kick
    {
        $kick = $this->currentKick($cond)->first();

        if (!$kick)
        {
            $kick = new Kick;

            foreach ($stuff as $key => $value)
            {
                $kick->$key = $value;
            }

            $kick->save();
        }

        return $kick;
    }

    /**
     * Create a new entity of type Character.
     *
     * @param int $base_id
     * @param int $nft_payment_id
     * @param Product $product
     * @param int|null $user_id
     * @return void The PK that identifies the instance.
     * @throws Exception
     */
    public static function create(int $base_id, int $nft_payment_id, Product $product, int $user_id = null): void
    {
        $character = new Character;
        $character->user_id = $user_id ?? Auth::user()->id;
        $character->base_id = $base_id;
        $character->payment_id = $nft_payment_id;
        $character->division = $product->division;
        $character->level = $product->level;
        $stats = $character->startingStats();
        $character->strength = random_int(intval($stats * .48), intval($stats * .52));
        $character->accuracy = $stats - $character->strength;
        $character->save();
    }
}
