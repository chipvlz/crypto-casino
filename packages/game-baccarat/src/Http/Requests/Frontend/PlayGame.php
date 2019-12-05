<?php

namespace Packages\GameBaccarat\Http\Requests\Frontend;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Rules\BalanceIsSufficient;
use Packages\GameBaccarat\Models\GameBaccarat;

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
            return $game && $game->gameable_type == GameBaccarat::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_CREATED;
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
            'bet_type'  => 'required|in:' .implode(',', GameBaccarat::getBetTypes()),
            'bet'       => 'required|numeric|min:' . config('game-baccarat.min_bet') . '|max:' . config('game-baccarat.max_bet'),
            '*'         => new BalanceIsSufficient($request->bet)
        ];
    }
}
