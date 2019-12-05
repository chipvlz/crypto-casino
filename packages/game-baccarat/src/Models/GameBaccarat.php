<?php

namespace Packages\GameBaccarat\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;

class GameBaccarat extends Model
{
    const BET_TYPE_PLAYER   = 0;
    const BET_TYPE_BANKER   = 1;
    const BET_TYPE_TIE      = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_baccarat';

    /**
     * This format will be used when the model is serialized to an array or JSON.
     *
     * @var array
     */
    protected $casts = [
        'deck'          => 'array',
        'player_hand'   => 'array',
        'banker_hand'   => 'array',
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
        if ($this->player_total > $this->banker_total && $this->bet_type == self::BET_TYPE_PLAYER
            || $this->player_total < $this->banker_total && $this->bet_type == self::BET_TYPE_BANKER
            || $this->player_total == $this->banker_total && $this->bet_type == self::BET_TYPE_TIE)
            return __('Win');

        return __('Nothing');
    }

    public function getBetTypeTitleAttribute()
    {
        if ($this->bet_type == self::BET_TYPE_PLAYER)
            return __('Player');
        elseif ($this->bet_type == self::BET_TYPE_BANKER)
            return __('Banker');
        else
            return __('Tie');
    }

    public static function getBetTypes(): array
    {
        return [
            self::BET_TYPE_PLAYER,
            self::BET_TYPE_BANKER,
            self::BET_TYPE_TIE
        ];
    }
}
