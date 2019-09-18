<?php

namespace Packages\GameVideoPoker\Services;

use App\Helpers\Games\CardDeck;
use App\Services\GameService;
use Illuminate\Database\Eloquent\Model;
use Packages\GameVideoPoker\Models\GameVideoPoker;

class GameVideoPokerService extends GameService
{
    protected $gameableModel = GameVideoPoker::class;

    private $deck;

    public function __construct($user = NULL)
    {
        parent::__construct($user);
        $this->deck = new CardDeck();
    }

    protected function createGameable(): Model
    {
        $gameable = new GameVideoPoker();
        $gameable->bet_coins = 0;
        $gameable->bet_amount = 0;
        $gameable->deck = implode(',', $this->deck->get());
        $gameable->save();

        return $gameable;
    }

    protected function makeSecret(): string
    {
        return implode(',', $this->deck->shuffle()->get()); // convert shuffled deck to comma-delimited string
    }

    protected function adjustSecret(): string
    {
        return implode(',', $this->deck->cut($this->game->shift_value % 52)->get());
    }

    /**
     * Deal initial set of cards
     *
     * @param $params
     */
    public function draw($params): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // load initially shuffled deck
        $this->deck->set(explode(',', $this->game->secret));

        $this->game->gameable->bet_coins = $params['bet_coins']; // bet coins (1 to 5)
        $this->game->gameable->bet_amount = $params['bet_amount']; // bet amount in credits
        $this->game->gameable->deck = $this->adjustSecret(); // cut the deck
        $this->game->gameable->combination = $this->getCombination($this->deck->get(5));

        $this->saveBet($this->game->gameable->bet_coins * $this->game->gameable->bet_amount);

        $this->game->gameable->draw = $this->deck->get(5);

        return $this;
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

        // It's important to unset draw property, otherwise when play() is called directly after draw()
        // Laravel will try to save draw property to DB and it will produce an exception.
        // This is relevant for bots feature.
        if (isset($this->game->gameable->draw))
            unset($this->game->gameable->draw);

        // load saved deck
        $this->deck->set(explode(',', $this->game->gameable->deck));

        $this->game->gameable->hold = implode(',', $params['hold']);

        $drawCount = 5;
        $draw = $this->deck->get($drawCount);

        for ($i = 0, $k = 0; $i < $drawCount; $i++) {
            if (!in_array($i, $params['hold'], TRUE))
                array_splice($draw, $i, 1, $this->deck->get(1, $drawCount + $k++));
        }

        $payTable = json_decode(config('game-video-poker.paytable'), true);
        $this->game->gameable->combination = $this->getCombination($draw);
        $win = $this->game->gameable->bet_amount * $payTable[$this->game->gameable->bet_coins - 1][$this->game->gameable->combination];

        // save game results and update user account balance
        $this->saveResult($win);

        $this->game->gameable->draw = $draw;

        return $this;
    }

    private function getCombination($cards)
    {
        $getRankBall = function ($card) {
            $idx = [
                't' => 10,
                'j' => 11,
                'q' => 12,
                'k' => 13,
                'a' => 14,
            ];
            return is_numeric($card[1]) ? $card[1] : $idx[$card[1]];
        };
        usort($cards, function ($a, $b) use ($getRankBall) {
            if ($a[1] == $b[1])
                return $a[0] < $b[0] ? -1 : 1;
            else
                return $getRankBall($a) < $getRankBall($b) ? -1 : 1;
        });

        if (
            count(array_diff(['dt', 'dj', 'dq', 'dk', 'da'], $cards)) == 0 ||
            count(array_diff(['ct', 'cj', 'cq', 'ck', 'ca'], $cards)) == 0 ||
            count(array_diff(['ht', 'hj', 'hq', 'hk', 'ha'], $cards)) == 0 ||
            count(array_diff(['st', 'sj', 'sq', 'sk', 'sa'], $cards)) == 0
        )
            return GameVideoPoker::HAND_ROYAL_FLUSH;
        elseif (
            count(array_unique([$cards[0][0], $cards[1][0], $cards[2][0], $cards[3][0], $cards[4][0]])) == 1 &&
            (
                count(array_unique([
                    $getRankBall($cards[0]) - 0,
                    $getRankBall($cards[1]) - 1,
                    $getRankBall($cards[2]) - 2,
                    $getRankBall($cards[3]) - 3,
                    $getRankBall($cards[4]) - 4])) == 1 ||
                (
                    $getRankBall($cards[4]) == 14 &&
                    $getRankBall($cards[0]) == 2 &&
                    count(array_unique([
                        $getRankBall($cards[0]) - 0,
                        $getRankBall($cards[1]) - 1,
                        $getRankBall($cards[2]) - 2,
                        $getRankBall($cards[3]) - 3])) == 1
                )
            )
        )
            return GameVideoPoker::HAND_STRAIGHT_FLUSH;
        elseif (
        in_array(4, array_count_values([
            $cards[0][1],
            $cards[1][1],
            $cards[2][1],
            $cards[3][1],
            $cards[4][1]
        ]))
        )
            return GameVideoPoker::HAND_FOUR_OF_A_KIND;
        elseif (
            in_array(3, array_count_values([
                $cards[0][1],
                $cards[1][1],
                $cards[2][1],
                $cards[3][1],
                $cards[4][1]
            ])) &&
            in_array(2, array_count_values([
                $cards[0][1],
                $cards[1][1],
                $cards[2][1],
                $cards[3][1],
                $cards[4][1]
            ]))
        )
            return GameVideoPoker::HAND_FULL_HOUSE;
        elseif (count(array_unique([$cards[0][0], $cards[1][0], $cards[2][0], $cards[3][0], $cards[4][0]])) == 1)
            return GameVideoPoker::HAND_FLUSH;
        elseif (
            count(array_unique([
                $getRankBall($cards[0]) - 0,
                $getRankBall($cards[1]) - 1,
                $getRankBall($cards[2]) - 2,
                $getRankBall($cards[3]) - 3,
                $getRankBall($cards[4]) - 4])) == 1 ||
            (
                $getRankBall($cards[4]) == 14 &&
                $getRankBall($cards[0]) == 2 &&
                count(array_unique([
                    $getRankBall($cards[0]) - 0,
                    $getRankBall($cards[1]) - 1,
                    $getRankBall($cards[2]) - 2,
                    $getRankBall($cards[3]) - 3])) == 1
            )
        )
            return GameVideoPoker::HAND_STRAIGHT;
        elseif (
        in_array(3, array_count_values([
            $cards[0][1],
            $cards[1][1],
            $cards[2][1],
            $cards[3][1],
            $cards[4][1]
        ]))
        )
            return GameVideoPoker::HAND_THREE_OF_A_KIND;
        elseif (
            (array_count_values(
                array_count_values([
                    $cards[0][1],
                    $cards[1][1],
                    $cards[2][1],
                    $cards[3][1],
                    $cards[4][1]
                ]))[2] ?? 0) == 2
        )
            return GameVideoPoker::HAND_TWO_PAIR;
        elseif (
            in_array(2, array_count_values([
                $cards[0][1],
                $cards[1][1],
                $cards[2][1],
                $cards[3][1],
                $cards[4][1]
            ])) &&
            $getRankBall("n" . array_search(2, array_count_values([
                    $cards[0][1],
                    $cards[1][1],
                    $cards[2][1],
                    $cards[3][1],
                    $cards[4][1]
                ]))) > 10
        )
            return GameVideoPoker::HAND_JACKS_OR_BETTER;

        return GameVideoPoker::HAND_NONE;
    }
}