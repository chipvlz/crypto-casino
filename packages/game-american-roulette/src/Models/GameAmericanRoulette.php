<?php

namespace Packages\GameAmericanRoulette\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;

class GameAmericanRoulette extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_american_roulette';

    /**
     * This format will be used when the model is serialized to an array or JSON.
     *
     * @var array
     */
    protected $casts = [
        'position' => 'integer',
    ];

    public function game()
    {
        return $this->morphOne(Game::class, 'gameable');
    }

    public function getBets1Attribute()
    {
        return $this->bets ? unserialize($this->bets) : [];
    }

    /**
     * Format $gameable->result attribute
     *
     * @return string
     */
    public function getBetAttribute(): string
    {
        $result = [];

        if ($this->bets) {
            $result = array_map(function($bet) {
                list ($type, $amount) = explode(':', $bet);
                return $this->getBetTitle($type) . ':' . $amount;
            }, explode(',', $this->bets));
        }

        return implode(', ', $result);
    }

    /**
     * Format $gameable->result attribute
     *
     * @return string
     */
    public function getResultAttribute(): string
    {
        $result = [];

        if ($this->wins) {
            $result = array_map(function($type) {
                return $this->getBetTitle($type);
            }, explode(',', $this->wins));
        } else {
            $result[] = __('Nothing');
        }

        return implode(', ', $result);
    }

    private function getBetTitle($type)
    {
        if ($type == 'red') {
            return __('Red');
        } elseif ($type == 'black') {
            return __('Black');
        } elseif ($type == 'odd') {
            return __('Odd');
        } elseif ($type == 'even') {
            return __('Even');
        } elseif ($type == 'low') {
            return __('Low');
        } elseif ($type == 'high') {
            return __('High');
        } elseif ($type == 'top_line') {
            return __('Top line');
        } elseif ($type == 'trio12') {
            return __('Trio 0-1-2');
        } elseif ($type == 'trio23') {
            return __('Trio 00-2-3');
        } elseif ($type == 'trio2') {
            return __('Trio 0-00-2');
        } elseif (preg_match('#dozen([1,2,3]{1})#', $type, $matches)) {
            return __('Dozen :n1-:n2', ['n1' => ($matches[1]-1)*12 + 1, 'n2' => $matches[1] * 12]);
        } elseif (preg_match('#column([1,2,3]{1})#', $type, $matches)) {
            return __('Column :n', ['n' => $matches[1]]);
        } elseif (preg_match('#street(\d+)#', $type, $matches)) {
            return __('Street :n1-:n2', ['n1' => $matches[1], 'n2' => $matches[1] + 3]);
        } elseif (preg_match('#corner(\d+)#', $type, $matches)) {
            return __('Corner :n1,:n2,:n3,:n4', ['n1' => $matches[1], 'n2' => $matches[1] + 1, 'n3' => $matches[1] + 3, 'n4' => $matches[1] + 4]);
        } elseif (preg_match('#split(\d+)_(\d+)#', $type, $matches)) {
            return __('Split :n1-:n2', ['n1' => $matches[1], 'n2' => $matches[2]]);
        } elseif (preg_match('#straight(\d+)#', $type, $matches)) {
            return __('Straight :n', ['n' => $matches[1]]);
        } elseif (preg_match('#sixline(\d+)#', $type, $matches)) {
            return __('Six line :n1-:n2', ['n1' => $matches[1], 'n2' => $matches[1] + 5]);
        } else {
            return 'UNKNOWN';
        }
    }
}
