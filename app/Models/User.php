<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

/**
 * The User model.
 *
 * @property int    $id                The PK that identifies the instance.
 * @property string $name              The username.
 * @property string $email             The user email.
 * @property string $email_verified_at When the current email was verified.
 * @property string $password          The user password.
 * @property string $goal              GOAL balance.
 * @property string $gls               GLS balance.
 * @property string $remember_token    Remember password token.
 * @property Carbon $created_at        When the user signed up.
 * @property Carbon $updated_at        When the user was last updated.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_PRESIDENT = 0, ROLE_AGENT = 1, ROLE_PLAYER = 2, ROLE_NORMAL = 3, ROLE_GRANTEE = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * Get the user purchases.
     *
     * @return HasMany
     */
    public function nftPayments(): HasMany
    {
        return $this->hasMany(NftPayment::class);
    }

    /**
     * Get the user characters.
     *
     * @return HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }

    /**
     * Get the user characters by division.
     *
     * @param int $division
     * @return HasMany
     */
    public function charactersByDivision(int $division): HasMany
    {
        return $this->hasMany(Character::class)->where('division', $division);
    }

    /**
     * Get the user stakings.
     *
     * @return HasMany
     */
    public function stakings(): HasMany
    {
        return $this->hasMany(Staking::class);
    }

    /**
     * Whether the user is a president or not.
     *
     * @return bool
     */
    public function isPresident(): bool
    {
        return $this->role === self::ROLE_PRESIDENT;
    }

    /**
     * Whether the user is an agent or not.
     *
     * @return bool
     */
    public function isAgent(): bool
    {
        return $this->role === self::ROLE_AGENT;
    }

    /**
     * Whether the user is a player or not.
     *
     * @return bool
     */
    public function isPlayer(): bool
    {
        return $this->role === self::ROLE_PLAYER;
    }

    /**
     * Whether the user is standard or not.
     *
     * @return bool
     */
    public function isNormal(): bool
    {
        return $this->role === self::ROLE_NORMAL;
    }

    /**
     * Whether the user is a grantee or not.
     *
     * @return bool
     */
    public function isGrantee(): bool
    {
        return $this->role === self::ROLE_GRANTEE;
    }
}
