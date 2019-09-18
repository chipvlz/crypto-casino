<?php

namespace Packages\GameVideoPoker\Models;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GameVideoPoker extends Model
{
    const HAND_NONE = 0;
    const HAND_JACKS_OR_BETTER = 1;
    const HAND_TWO_PAIR = 2;
    const HAND_THREE_OF_A_KIND = 3;
    const HAND_STRAIGHT = 4;
    const HAND_FLUSH = 5;
    const HAND_FULL_HOUSE = 6;
    const HAND_FOUR_OF_A_KIND = 7;
    const HAND_STRAIGHT_FLUSH = 8;
    const HAND_ROYAL_FLUSH = 9;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_video_poker';

    /**
     * The attributes that should be hidden from JSON output.
     *
     * @var array
     */
    protected $hidden = ['deck'];

    /**
     * This format will be used when the model is serialized to an array or JSON.
     *
     * @var array
     */
    protected $casts = [
        'bet_coins' => 'integer',
        'bet_amount' => 'float',
    ];

    public function game()
    {
        return $this->morphOne(Game::class, 'gameable');
    }

    /**
     * Format $gameable->result attribute
     *
     * @return string
     */
    public function getResultAttribute(): string
    {
        switch ($this->combination) {
            case self::HAND_JACKS_OR_BETTER:
                return __('Jacks or better');
                break;

            case self::HAND_TWO_PAIR:
                return __('Two pair');
                break;

            case self::HAND_THREE_OF_A_KIND:
                return __('Three of a kind');
                break;

            case self::HAND_STRAIGHT:
                return __('Straight');
                break;

            case self::HAND_FLUSH:
                return __('Flush');
                break;

            case self::HAND_FULL_HOUSE:
                return __('Full house');
                break;

            case self::HAND_FOUR_OF_A_KIND:
                return __('Four of a kind');
                break;

            case self::HAND_STRAIGHT_FLUSH:
                return __('Straight flush');
                break;

            case self::HAND_ROYAL_FLUSH:
                return __('Royal flush');
                break;

            default:
                return __('Nothing');
        }
    }

    public static function combinations(): array
    {
        return [
            self::HAND_NONE               => __('None'),
            self::HAND_JACKS_OR_BETTER    => __('Jacks or better'),
            self::HAND_TWO_PAIR           => __('Two pair'),
            self::HAND_THREE_OF_A_KIND    => __('Three of a kind'),
            self::HAND_STRAIGHT           => __('Straight'),
            self::HAND_FLUSH              => __('Flush'),
            self::HAND_FULL_HOUSE         => __('Full house'),
            self::HAND_FOUR_OF_A_KIND     => __('Four of a kind'),
            self::HAND_STRAIGHT_FLUSH     => __('Straight flush'),
            self::HAND_ROYAL_FLUSH        => __('Royal flush'),
        ];
    }
}
