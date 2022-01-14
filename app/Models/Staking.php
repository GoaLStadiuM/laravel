<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * The Staking model.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property int    $user_id    The foreign key to the staker.
 * @property int    $option_id  The foreign key to the chosen option.
 * @property string $tx_hash    The transaction hash.
 * @property string $created_at When the staking started.
 * @property string $updated_at When the staking was last updated.
 */
class Staking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected string $table = 'staking';

    /**
     * Get the user that owns the staking.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the staking option that owns the staking.
     *
     * @return BelongsTo
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(StakingOption::class);
    }
}
