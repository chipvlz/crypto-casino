<?php

namespace Packages\GameKeno\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;

class GameKeno extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_keno';

    /**
     * This format will be used when the model is serialized to an array or JSON.
     *
     * @var array
     */
    protected $casts = [
        'bet_numbers'  => 'array',
        'draw_numbers' => 'array',
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
        $hitsCount = count(array_intersect($this->bet_numbers, $this->draw_numbers));
        return $hitsCount ?
            trans_choice('1 hit|:n hits', $hitsCount, ['n' => $hitsCount]) :
            __('Nothing');
    }
}