<?php

namespace Packages\GameVideoPoker\Http\Requests\Frontend;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\GameVideoPoker\Models\GameVideoPoker;

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
            return $game && $game->gameable_type == GameVideoPoker::class && $game->account->user_id == $this->user()->id && $game->status == Game::STATUS_STARTED;
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
            'hold'      => 'array', // hold should be an array
            'hold.*'    => 'required|integer|min:0|max:4', // hold array should contain integers from 1 to 5
        ];
    }
}