<?php

namespace Packages\GameBlackjack\Http\Requests\Frontend;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\GameBlackjack\Models\GameBlackjack;
use Packages\GameBlackjack\Rules\SplitHitStandAllowed;

class SplitHitStand extends FormRequest
{
    private $game;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->game_id) {
            $this->game = Game::find($this->game_id);
            return $this->game && $this->game->gameable_type == GameBlackjack::class && $this->game->account->user_id == $this->user()->id && $this->game->status == Game::STATUS_STARTED;
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
            'hand'      => 'required|integer|min:1|max:2',
            '*'         => new SplitHitStandAllowed($this->game->gameable, $request->hand)
        ];
    }
}