<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * The Staking model.
 *
 * @property int    $id         The PK that identifies the instance.
 * @property int    $user_id    The FK to the staker.
 * @property int    $option_id  The FK to the chosen option.
 * @property string $tx_hash    The transaction hash.
 * @property Carbon $created_at When the staking started.
 * @property Carbon $updated_at When the staking was last updated.
 */
class Staking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'staking';

    /**
     * Get the staker.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the chosen option.
     *
     * @return BelongsTo
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(StakingOption::class);
    }
}
