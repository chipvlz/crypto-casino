<?php

namespace Packages\GameVideoPoker\Http\Requests\Frontend;

use App\Models\Game;
use App\Rules\BalanceIsSufficient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\GameVideoPoker\Models\GameVideoPoker;

class DrawCards extends FormRequest
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
            return $game && $game->gameable_type == GameVideoPoker::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_CREATED;
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
            'bet_coins'     => 'required|integer|min:1|max:5',
            'bet_amount'    => 'required|numeric|min:' . config('game-video-poker.min_bet') . '|max:' . config('game-video-poker.max_bet'),
            '*' => new BalanceIsSufficient($request->bet_coins * $request->bet_amount)
        ];
    }
}