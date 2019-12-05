<?php

namespace Packages\GameLuckyWheel\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;

class GameLuckyWheel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_lucky_wheel';

    public function game()
    {
        return $this->morphOne(Game::class, 'gameable');
    }

    /**
     * Format $gameable->result attribute
     *
     * @return string
     */
    public function getResultAttribute()
    {
        $result = [];

        return $this->win > 0
            ? config('game-lucky-wheel.variations')[$this->game_index]->title
            : __('Nothing');
    }

    public function getTitleAttribute()
    {
        return __(config('game-lucky-wheel.variations')[$this->game_index]->title ?? 'Lucky Wheel');
    }
}
