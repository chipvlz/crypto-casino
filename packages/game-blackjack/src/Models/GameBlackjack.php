<?php

namespace Packages\GameBlackjack\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;

class GameBlackjack extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_blackjack';

    /**
     * The attributes that should be hidden from JSON output.
     *
     * @var array
     */
    protected $hidden = ['deck', 'dealer_hand', 'dealer_score', 'dealer_blackjack'];

    protected $appends = ['dealer_hand_first_card'];

    /**
     * This format will be used when the model is serialized to an array or JSON.
     *
     * @var array
     */
    protected $casts = [
        'bet' => 'integer',
        'bet2' => 'integer',
        'win' => 'float',
        'win2' => 'float',
        'insurance_bet' => 'float',
        'insurance_win' => 'float',
        'player_score' => 'integer',
        'player_score2' => 'integer',
        'player_blackjack' => 'boolean',
        'dealer_blackjack' => 'boolean',
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
        $result = [];
        
        if ($this->player_blackjack && !$this->dealer_blackjack) {
            $result[] = __('Blackjack');
        } else if (!$this->player_blackjack && $this->dealer_blackjack) {
            $result[] = __('Loss');
        } else if ($this->player_blackjack && $this->dealer_blackjack) {
            $result[] = __('Push');
        // split
        } else if ($this->player_hand2) {
            if ($this->win > $this->bet) {
                $result[] = __('1st hand win');
            } else if ($this->win < $this->bet) {
                $result[] = __('1st hand loss');
            } else {
                $result[] = __('1st hand push');
            }
            if ($this->win2 > $this->bet2) {
                $result[] = __('2nd hand win');
            } else if ($this->win2 < $this->bet2) {
                $result[] = __('2nd hand loss');
            } else {
                $result[] = __('2nd hand push');
            }
        // regular win
        } else if ($this->win > $this->bet) {
            $result[] = __('Win');
        // regular loss
        } else if ($this->win < $this->bet) {
            $result[] = __('Loss');
        // regular push
        } else {
            $result[] = __('Push');
        }

        if ($this->insurance_bet > 0 && $this->insurance_win > 0) {
            $result[] = __('Insurance win');
        } else if ($this->insurance_bet > 0 && $this->insurance_win == 0) {
            $result[] = __('Insurance loss');
        }

        return implode(', ', $result);
    }

    /**
     * Return first card of the dealer hand (visible to the player after the draw).
     *
     * @return string
     */
    public function getDealerHandFirstCardAttribute()
    {
        return $this->dealer_hand ? explode(',', $this->dealer_hand)[0] : NULL;
    }
}
