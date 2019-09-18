<?php

namespace Packages\GameRoulette\Rules;

use Illuminate\Contracts\Validation\Rule;
use Packages\GameRoulette\Services\GameRouletteService;

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
        $minBet = min(array_values($value));
        $maxBet = max(array_values($value));

        return GameRouletteService::betsAreValid($value) &&
            $minBet >= config('game-roulette.min_bet') &&
            $maxBet <= config('game-roulette.max_bet');
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