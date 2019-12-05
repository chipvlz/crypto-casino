<?php

namespace Packages\GameLuckyWheel\Services;

use App\Helpers\Games\NumberGenerator;
use App\Services\GameService;
use Illuminate\Database\Eloquent\Model;
use Packages\GameLuckyWheel\Models\GameLuckyWheel;

class GameLuckyWheelService extends GameService
{
    protected $gameableModel = GameLuckyWheel::class;

    private $index = NULL;
    private $numberGenerator;

    public function __construct($user = NULL)
    {
        parent::__construct($user);

        $variations = config('game-lucky-wheel.variations');
        $slug = request()->route()->index ?? NULL;

        // game is accessed by slug
        if (!is_null($slug) && preg_match('#[a-z]+#i', $slug)) {
            $i = array_search($slug, array_column((array) $variations, 'slug'), TRUE);
            $this->index = $i !== FALSE ? $i : NULL;
        // game is accessed by its index
        } else if (!is_null($slug) && $slug == intval($slug) && array_key_exists($slug, $variations)) {
            $this->index = $slug;
        // randomly choose game when it is created from console and HTTP request is not available
        } elseif (is_null($slug)) {
            $this->index = random_int(0, count($variations)-1);
        }

        if (!is_null($this->index)) {
            $this->numberGenerator = new NumberGenerator(0, count($variations[$this->index]->sections)-1);
        }
    }

    protected function createGameable(): Model
    {
        $gameable = new GameLuckyWheel();
        $gameable->position = 0;
        $gameable->save();

        return $gameable;
    }

    protected function makeSecret(): string
    {
        return $this->numberGenerator->generate()->getNumber();
    }

    protected function adjustSecret(): string
    {
        return $this->numberGenerator->shift($this->game->shift_value)->getNumber();
    }

    /**
     * Play game
     *
     * @return mixed
     */
    public function play($params): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // set initial wheel position
        $this->numberGenerator->setNumber($this->game->secret);
        $this->game->gameable->position = $this->adjustSecret(); // shift result number by another random result
        $this->game->gameable->game_index = $this->index;

        $config = config('game-lucky-wheel.variations')[$this->index];
        $bet = intval($params['bet']);
        $win = $bet * $config->sections[$this->numberGenerator->getNumber()]->payout;

        // save game results and update user account balance
        $this->complete($bet, $win);

        return $this;
    }

    /**
     * Get game index
     *
     * @return int|null
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }
}
