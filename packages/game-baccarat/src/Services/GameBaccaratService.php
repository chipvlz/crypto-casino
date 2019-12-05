<?php

namespace Packages\GameBaccarat\Services;

use App\Helpers\Games\CardDeck;
use App\Services\GameService;
use Illuminate\Database\Eloquent\Model;
use Packages\GameBaccarat\Models\GameBaccarat;

class GameBaccaratService extends GameService
{
    protected $gameableModel = GameBaccarat::class;
    private $deck;

    public function __construct($user = NULL)
    {
        parent::__construct($user);
        $this->deck = new CardDeck();
    }

    protected function createGameable(): Model
    {
        $gameable = new GameBaccarat();
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
    public function play($params): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // load initially shuffled deck
        $this->deck->set(explode(',', $this->game->secret));

        $deck = explode(',', $this->adjustSecret()); // cut the deck
        $playerHand = [$this->deck->get(1,0)[0], $this->deck->get(1,2)[0]];
        $bankerHand = [$this->deck->get(1,1)[0], $this->deck->get(1,3)[0]];

//         $dealerHand[0] = 'da';
//         $playerHand = ['s9', 'd9'];
//         $dealerHand = ['da', 's4'];
        // $dealerHand = ['d2', 'd3'];

        $playerTotal = $this->calculateHandTotal($playerHand);
        $bankerTotal = $this->calculateHandTotal($bankerHand);

        // If the player has total of 5 or less, the player automatically hits
        if ($playerTotal <= 5) {
            $playerHand[] = $this->deck->get(1,4)[0];
            $playerTotal = $this->calculateHandTotal($playerHand);
        }

        // If the player stands, the banker hits on a total of 5 or less.
        if (($playerTotal == 6 || $playerTotal == 7) && $bankerTotal <= 5) {
            $bankerHand[] = $this->deck->get(1,5)[0];
            $bankerTotal = $this->calculateHandTotal($bankerHand);
        // If the player gets the third card then the banker draws a third card according to the following rules:
        } elseif(count($playerHand) == 3) {
            // Banker has total of 0, 1, 2: Banker always draws a third card.
            if ($bankerTotal <= 2
                // If the banker total is 3, then the banker draws a third card unless the player's third card was an 8.
                || $bankerTotal == 3 && $playerHand[2][1] != 8
                // If the banker total is 4, then the banker draws a third card if the player's third card was 2, 3, 4, 5, 6, 7.
                || $bankerTotal == 4 && in_array((int) $playerHand[2][1], [2, 3, 4, 5, 6, 7])
                // If the banker total is 5, then the banker draws a third card if the player's third card was 4, 5, 6, or 7.
                || $bankerTotal == 5 && in_array((int) $playerHand[2][1], [4, 5, 6, 7])
                // If the banker total is 6, then the banker draws a third card if the player's third card was a 6 or 7.
                || $bankerTotal == 6 && in_array((int) $playerHand[2][1], [6, 7])) {
                $bankerHand[] = $this->deck->get(1,5)[0];
                $bankerTotal = $this->calculateHandTotal($bankerHand);
            }
        }

        $this->game->gameable->bet_type = $params['bet_type'];
        $this->game->gameable->deck = $deck;
        $this->game->gameable->player_hand = $playerHand;
        $this->game->gameable->player_total = $playerTotal;
        $this->game->gameable->banker_hand = $bankerHand;
        $this->game->gameable->banker_total = $bankerTotal;

        $bet = (int) $params['bet'];
        $win = 0;

        if ($playerTotal > $bankerTotal && $params['bet_type'] == GameBaccarat::BET_TYPE_PLAYER)
            $win = $bet * (float) config('game-baccarat.payouts.player');
        elseif ($playerTotal < $bankerTotal && $params['bet_type'] == GameBaccarat::BET_TYPE_BANKER)
            $win = $bet * (float) config('game-baccarat.payouts.banker');
        elseif ($playerTotal == $bankerTotal && $params['bet_type'] == GameBaccarat::BET_TYPE_TIE)
            $win = $bet * (float) config('game-baccarat.payouts.tie');

        $this->complete($bet, $win);

        return $this;
    }

    /**
     * Calculate hand score
     *
     * @param array $hand
     * @return float
     */
    private function calculateHandTotal(array $hand): float
    {
        $score = 0;

        $getCardScore = function ($cardValue) {
            if (intval($cardValue) > 0)
                return intval($cardValue);
            // aces have score of 1
            elseif ($cardValue == 'a')
                return 1;
            //  jack, queen, and king are worth zero
            else
                return 0;
        };

        // loop through cards and calculate score
        foreach ($hand as $card) {
            $score += $getCardScore(substr($card, 1, 1));
        }

        // if score is >= 10 return only the right digit
        return $score < 10 ? $score : (int) substr($score, 1, 1);
    }
}
