<?php

namespace Packages\GameBlackjack\Rules;

use Illuminate\Contracts\Validation\Rule;
use Packages\GameBlackjack\Models\GameBlackjack;

class InsuranceBetAllowed implements Rule
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
        if ($this->game->dealer_hand) {
            $playerHand = explode(',', $this->game->player_hand);
            $dealerFirstCard = explode(',', $this->game->dealer_hand)[0];
            return count($playerHand) == 2 && $this->game->insurance_bet == 0 && $dealerFirstCard[1] == 'a' ? TRUE : FALSE;
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
        return __('Insurance can only be made when the first dealer card is an ace.');
    }
}