<?php

namespace Packages\GameDice\Http\Requests\Frontend;

use App\Models\Game;
use App\Rules\BalanceIsSufficient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\GameDice\Models\GameDice;

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
            return $game && $game->gameable_type == GameDice::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_CREATED;
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
            'direction' => 'required|in:-1,1',
            'bet'       => [
                'required',
                'integer',
                'min:' . config('game-dice.min_bet'),
                'max:' . config('game-dice.max_bet'),
                new BalanceIsSufficient($request->bet)
            ],
            'win_chance' => 'required|numeric|min:' . config('game-dice.min_win_chance') . '|max:' . config('game-dice.max_win_chance'),
        ];
    }
}