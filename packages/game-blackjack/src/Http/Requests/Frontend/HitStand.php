<?php

namespace Packages\GameBlackjack\Http\Requests\Frontend;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\GameBlackjack\Models\GameBlackjack;

class HitStand extends FormRequest
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
            return $game && $game->gameable_type == GameBlackjack::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_STARTED;
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
            'game_id'   => 'required|integer'
        ];
    }
}