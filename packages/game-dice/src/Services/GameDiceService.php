<?php

namespace Packages\GameDice\Services;

use App\Helpers\Games\NumberGenerator;
use App\Services\GameService;
use Illuminate\Database\Eloquent\Model;
use Packages\GameDice\Models\GameDice;

class GameDiceService extends GameService
{
    protected $gameableModel = GameDice::class;

    private $numberGenerator;

    public function __construct($user = NULL)
    {
        parent::__construct($user);
        $this->numberGenerator = new NumberGenerator();
    }

    protected function createGameable(): Model
    {
        $gameable = new GameDice();
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
     * Play roulette
     *
     * @param $params
     */
    public function play($params): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        $direction = intval($params['direction']);
        $bet = intval($params['bet']);
        $winChance = round(floatval($params['win_chance']), 2);

        // load initial roulette position
        $this->numberGenerator->setNumber($this->game->secret);

        $this->game->gameable->direction = $direction;
        $this->game->gameable->win_chance = floatval($winChance);
        $this->game->gameable->payout = $this->calcPayout($winChance);
        $this->game->gameable->ref_number = $this->calcRefNumber($direction, $winChance);
        $this->game->gameable->roll = $this->adjustSecret(); // shift result number by another random result

        $win = ($direction < 0 && $this->game->gameable->roll < $this->game->gameable->ref_number) || ($direction > 0 && $this->game->gameable->roll > $this->game->gameable->ref_number) ?
            round($bet * $this->game->gameable->payout, 2) : 0;

        // complete the game
        $this->complete($bet, $win);

        return $this;
    }

    private function calcPayout(float $winChance): float
    {
        return (100 - config('game-dice.house_edge')) / $winChance;
    }

    private function calcRefNumber(int $direction, float $winChance): int
    {
        return $direction < 0 ?
            round($winChance * 100) :
            $this->numberGenerator->getMax() - round($winChance * 100);
    }
}