<?php

namespace Packages\GameAmericanRoulette\Http\Requests\Frontend;

use App\Models\Game;
use App\Rules\BalanceIsSufficient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\GameAmericanRoulette\Models\GameAmericanRoulette;
use Packages\GameAmericanRoulette\Services\GameAmericanRouletteService;
use Packages\GameAmericanRoulette\Rules\BetsAreValid;

class Play extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->game_id) {
            $game = Game::find($this->game_id);
            return $game && $game->gameable_type == GameAmericanRoulette::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_CREATED;
        }

        return FALSE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'game_id'   => 'required|integer',
            'bets'      => [
                'required',
                'array',
                new BetsAreValid()
            ],
            '*'         => new BalanceIsSufficient(GameAmericanRouletteService::calcBetAmount($request->bets))
        ];
    }
}
