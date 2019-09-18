<?php

namespace Packages\GameMultiSlots\Http\Requests\Frontend;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Rules\BalanceIsSufficient;
use Packages\GameMultiSlots\Models\GameMultiSlots;

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
            return $game && $game->gameable_type == GameMultiSlots::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_CREATED;
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
            'lines_count'   => 'required|integer|min:1|max:20',
            'bet'           => 'required|numeric|min:' . config('game-multi-slots.min_bet')[$index] . '|max:' . config('game-multi-slots.max_bet')[$index],
            '*'             => new BalanceIsSufficient($request->lines_count * $request->bet)
        ];
    }
}