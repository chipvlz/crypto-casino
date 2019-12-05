<?php

namespace Packages\GameLuckyWheel\Http\Requests\Frontend;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Rules\BalanceIsSufficient;
use Packages\GameLuckyWheel\Models\GameLuckyWheel;

class PlayGame extends FormRequest
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
            return $game && $game->gameable_type == GameLuckyWheel::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_CREATED;
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
        $index = $request->route()->index;

        return [
            'bet' => 'required|numeric|min:' . config('game-lucky-wheel.variations')[$index]->min_bet . '|max:' . config('game-lucky-wheel.variations')[$index]->max_bet,
            '*'   => new BalanceIsSufficient($request->bet)
        ];
    }
}
