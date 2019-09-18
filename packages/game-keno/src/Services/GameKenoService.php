<?php

namespace Packages\GameKeno\Services;

use App\Services\GameService;
use Illuminate\Database\Eloquent\Model;
use Packages\GameKeno\Helpers\Keno;
use Packages\GameKeno\Models\GameKeno;

class GameKenoService extends GameService
{
    protected $gameableModel = GameKeno::class;

    private $keno;

    public function __construct($user = NULL)
    {
        parent::__construct($user);
        $this->keno = new Keno();
    }

    protected function createGameable(): Model
    {
        $gameable = new GameKeno();
        $gameable->save();

        return $gameable;
    }

    protected function makeSecret(): string
    {
        return implode(',', $this->keno->drawNumbers()->getNumbers());
    }

    protected function adjustSecret(): string
    {
        return NULL;
    }

    /**
     * Play game
     *
     * @param $params
     */
    public function play($params): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // load keno numbers
        $this->keno->setNumbers(array_map('intval', explode(',', $this->game->secret)));
        $this->keno->shiftBalls($this->game->shift_value);  // shift balls randomly

        $this->game->gameable->bet_numbers = $params['bet_numbers'];
        $this->game->gameable->draw_numbers = $this->keno->getNumbers();

        $bet = intval($params['bet']);
        $hitsCount = count(array_intersect($this->game->gameable->bet_numbers, $this->game->gameable->draw_numbers));
        $win = $hitsCount > 0 ? $bet * floatval(config('game-keno.payouts')[$hitsCount]) : 0;

        // complete the game
        $this->complete($bet, $win);

        return $this;
    }
}