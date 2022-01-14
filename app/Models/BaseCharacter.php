<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * The Base character model.
 *
 * Represents a soccer player.
 *
 * @property int    $id          The PK that identifies the instance.
 * @property string $name        The name of the soccer player.
 * @property int    $probability The probability of getting this soccer player
 *                               when purchasing an NFT character.
 * @property string $video_url   The url of the soccer player's video.
 * @property string $img_url     The url of the soccer player's image.
 * @property string $created_at  When this soccer player was added to the game.
 * @property string $updated_at  When this soccer player was last updated.
 */
class BaseCharacter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected string $table = 'base_character';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected array $fillable = [
        'name',
        'probability',
        'video_url',
        'img_url',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the characters for the base character.
     *
     * @return HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class, 'id', 'base_id');
    }
}
