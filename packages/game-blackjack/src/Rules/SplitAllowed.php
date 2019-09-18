<?php

namespace Packages\GameBlackjack\Rules;

use Illuminate\Contracts\Validation\Rule;
use Packages\GameBlackjack\Models\GameBlackjack;

class SplitAllowed implements Rule
{
    private $game;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(GameBlackjack $game)
    {
        $this->game = $game;
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
        if ($this->game->player_hand) {
            $playerHand = explode(',', $this->game->player_hand);

            return count($playerHand) == 2 &&
                !$this->game->player_hand2 &&
                !$this->game->player_score2 &&
                $this->game->bet2 == 0 &&
                $this->game->win2 == 0 &&
                $playerHand[0][1] == $playerHand[1][1]; // equal cards
        }

        return FALSE;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Split is not allowed.');
    }
}