<?php

namespace Packages\GameAmericanRoulette\Rules;

use Illuminate\Contracts\Validation\Rule;
use Packages\GameAmericanRoulette\Services\GameAmericanRouletteService;

class BetsAreValid implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $bets = array_values($value);
        $minBet = min($bets);
        $maxBet = max($bets);
        $totalBet = array_sum($bets);

        return GameAmericanRouletteService::betsAreValid($value) &&
            $minBet >= config('game-american-roulette.min_bet') &&
            $maxBet <= config('game-american-roulette.max_bet') &&
            $totalBet <= config('game-american-roulette.max_total_bet');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('This bet is not allowed.');
    }
}
