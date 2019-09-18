<?php

namespace Packages\GameBlackjack\Rules;

use Illuminate\Contracts\Validation\Rule;
use Packages\GameBlackjack\Models\GameBlackjack;

class SplitHitStandAllowed implements Rule
{
    private $game;
    private $hand;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(GameBlackjack $game, int $hand)
    {
        $this->game = $game;
        $this->hand = $hand;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->game->player_hand2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Hit / stand is not allowed.');
    }
}