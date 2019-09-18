<?php

namespace Packages\GameAmericanBingo\Services;

use App\Services\GameService;
use Illuminate\Database\Eloquent\Model;
use Packages\GameAmericanBingo\Helpers\AmericanBingo;
use Packages\GameAmericanBingo\Models\GameAmericanBingo;

class GameAmericanBingoService extends GameService
{
    protected $gameableModel = GameAmericanBingo::class;

    private $bingo;

    public function __construct($user = NULL)
    {
        parent::__construct($user);
        $this->bingo = new AmericanBingo();
    }

    protected function createGameable(): Model
    {
        $gameable = new GameAmericanBingo();
        $gameable->save();

        return $gameable;
    }

    protected function makeSecret(): string
    {
        return implode(',', $this->bingo->drawBalls()->getBalls());
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

        // load bingo
        $this->bingo->generateCard();
        $this->bingo->setBalls(array_map('intval', explode(',', $this->game->secret)));
        $this->bingo->shiftBalls($this->game->shift_value);  // shift balls randomly
        $this->bingo->run();

        $this->game->gameable->card = $this->bingo->getCard();
        $this->game->gameable->balls = $this->bingo->getBalls();
        $this->game->gameable->win_patterns = $this->bingo->getWinPatterns();

        $bet = intval($params['bet']);
        $win = 0;
        foreach ($this->game->gameable->win_patterns as $winPattern) {
            $win += $bet * intval(config('game-american-bingo.payouts')[$winPattern]);
        }

        // complete the game
        $this->complete($bet, $win);

        $this->game->gameable->win_combinations = $this->bingo->getWinCombinations();

        return $this;
    }
}