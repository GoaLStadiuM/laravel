<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Staking Option model.
 *
 * @property int    $id               The PK that identifies the instance.
 * @property int    $vesting_period   The duration.
 * @property int    $bonus_percentage The bonus percentage used to calculate the reward.
 * @property string $created_at       When the staking option was added.
 * @property string $updated_at       When the staking option was last updated.
 */
class StakingOption extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected string $table = 'staking_option';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected array $fillable = [
        'vesting_period',
        'bonus_percentage',
        'created_at',
        'updated_at'
    ];

    // TODO: missing relationships
}
