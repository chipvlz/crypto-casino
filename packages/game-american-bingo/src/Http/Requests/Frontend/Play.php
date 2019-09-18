<?php

namespace Packages\GameAmericanBingo\Http\Requests\Frontend;

use App\Models\Game;
use App\Rules\BalanceIsSufficient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\GameAmericanBingo\Models\GameAmericanBingo;

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
            return $game && $game->gameable_type == GameAmericanBingo::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_CREATED;
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
            'bet'       => [
                'required',
                'integer',
                'min:' . config('game-american-bingo.min_bet'),
                'max:' . config('game-american-bingo.max_bet'),
                new BalanceIsSufficient($request->bet)
            ],
        ];
    }
}