<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
 * @property string $created_at        When the user signed up.
 * @property string $updated_at        When the user was last updated.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
}
