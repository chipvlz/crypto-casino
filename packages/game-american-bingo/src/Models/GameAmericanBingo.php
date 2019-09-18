<?php

namespace Packages\GameAmericanBingo\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;

class GameAmericanBingo extends Model
{
    const PATTERN_COLUMN        = 1;
    const PATTERN_ROW           = 2;
    const PATTERN_DIAGONAL      = 3;
    const PATTERN_CROSS         = 4; // 2 diagonals

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_american_bingo';

    /**
     * This format will be used when the model is serialized to an array or JSON.
     *
     * @var array
     */
    protected $casts = [
        'card'          => 'array',
        'balls'         => 'array',
        'win_patterns'  => 'array',
    ];

    public function game()
    {
        return $this->morphOne(Game::class, 'gameable');
    }

    /**
     * Format $gameable->result attribute
     *
     * @return string
     */
    public function getResultAttribute(): string
    {
        return !empty($this->win_patterns) ?
            implode(', ',
                array_map(function($winPattern) {
                    return __('app.american_bingo_pattern_' . $winPattern);
                }, $this->win_patterns)
            ) :
            __('Nothing');
    }


}
