<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * The Influencer model.
 *
 * @property int    $id           The PK that identifies the instance.
 * @property string $title        The influencer designation.
 * @property string $email        The influencer email.
 * @property int    $amount       The amount in BUSD to spend in the shop.
 * @property int    $share        A share from the tokenomics.
 * @property string $wallet       The wallet to send the monthly payment (from share).
 * @property string $country_code The influencer country code (ISO 3166-1 alpha-2 code).
 * @property int    $entity_id    The FK to the entity represented by the influencer.
 * @property Carbon $created_at   When the influencer joined the team.
 * @property Carbon $updated_at   When the influencer was last updated.
 */
class Influencer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'influencer';
}
