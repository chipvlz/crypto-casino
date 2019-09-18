<?php

namespace Packages\GameKeno\Http\Requests\Frontend;

use App\Models\Game;
use App\Rules\BalanceIsSufficient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\GameKeno\Models\GameKeno;

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
            return $game && $game->gameable_type == GameKeno::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_CREATED;
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
                'min:' . config('game-keno.min_bet'),
                'max:' . config('game-keno.max_bet'),
                new BalanceIsSufficient($request->bet)
            ],
            'bet_numbers' => 'required|array|size:10',
            'bet_numbers.*' => 'distinct|integer|min:1|max:80',
        ];
    }
}