<?php

namespace Packages\GameBlackjack\Services;

use App\Helpers\Games\CardDeck;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Database\Eloquent\Model;
use Packages\GameBlackjack\Models\GameBlackjack;

class GameBlackjackService extends GameService
{
    protected $gameableModel = GameBlackjack::class;

    private $deck;
    private $actions; // alowed game actions (to be passed to frontend)

    public function __construct($user = NULL)
    {
        parent::__construct($user);
        $this->deck = new CardDeck();
        $this->actions = [];
    }

    protected function createGameable(): Model
    {
        $gameable = new GameBlackjack();
        $gameable->deck = implode(',', $this->deck->get());
        $gameable->bet = 0;
        $gameable->win = 0;
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
    public function deal($params): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // load initially shuffled deck
        $this->deck->set(explode(',', $this->game->secret));

        $deck = $this->adjustSecret(); // cut the deck
        $playerHand = [$this->deck->get(1,0)[0], $this->deck->get(1,2)[0]];
        $dealerHand = [$this->deck->get(1,1)[0], $this->deck->get(1,3)[0]];

//         $dealerHand[0] = 'da';
//         $playerHand = ['s9', 'd9'];
//         $dealerHand = ['da', 's4'];
        // $dealerHand = ['d2', 'd3'];

        $this->game->gameable->bet = $params['bet']; // bet amount in credits
        $this->game->gameable->deck = $deck;
        $this->game->gameable->player_hand = implode(',', $playerHand);
        $this->game->gameable->player_score = $this->calculateScore($playerHand);
        $this->game->gameable->dealer_hand = implode(',', $dealerHand);
        $this->game->gameable->dealer_score = $this->calculateScore($dealerHand);

        $this->saveBet($this->game->gameable->bet);

        // if first dealer card is NOT an ace (which means that insurance is not available even if the dealer has blackjack)
        // or if player doesn't have enough funds to buy insurance
        if ($dealerHand[0][1] != 'a' || $this->game->account->balance < $this->game->gameable->bet / 2) {
            // if player has blackjack
            if ($this->game->gameable->player_score == 21 && $this->game->gameable->dealer_score != 21) {
                $this->game->gameable->player_blackjack = TRUE;
                $this->game->gameable->win = $this->game->gameable->bet * 3 / 2 + $this->game->gameable->bet; // blackjack pays 3/2
                $this->saveResult($this->game->gameable->win);
            // if dealer has blackjack
            } elseif ($this->game->gameable->player_score != 21 && $this->game->gameable->dealer_score == 21) {
                $this->game->gameable->dealer_blackjack = TRUE;
                $this->saveResult(0);
            // if both player and dealer have blackjack (push)
            } elseif ($this->game->gameable->player_score == 21 && $this->game->gameable->dealer_score == 21) {
                $this->game->gameable->player_blackjack = TRUE;
                $this->game->gameable->dealer_blackjack = TRUE;
                $this->game->gameable->win = $this->game->gameable->bet; // return bet
                $this->saveResult($this->game->gameable->win);
            }

            // game is finished (someone had a blackjack)
            if ($this->game->status == Game::STATUS_COMPLETED) {
                $this->game->gameable->makeVisible(['dealer_hand', 'dealer_score', 'dealer_blackjack']);
                array_push($this->actions, 'deal');
            } else {
                array_push($this->actions, 'hit', 'stand');
                // allow player to double the bet if user has sufficient funds
                if ($this->game->account->balance >= $this->game->gameable->bet) {
                    array_push($this->actions, 'double');
                    if ($playerHand[0][1] == $playerHand[1][1]) {
                        array_push($this->actions, 'split');
                    }
                }
            }
        // first dealer card is an ace and user has sufficient funds to place insurance bet
        } elseif ($dealerHand[0][1] == 'a' && $this->game->account->balance >= $this->game->gameable->bet / 2) {
            // allow player to take insurance
            array_push($this->actions, 'insurance', 'stand');

            // if player doesn't have blackjack
            if ($this->game->gameable->player_score < 21) {
                array_push($this->actions, 'hit');
                // allow player to double the bet if user has sufficient funds
                if ($this->game->account->balance >= $this->game->gameable->bet) {
                    array_push($this->actions, 'double');
                    // allow player to split hands if cards have the same value
                    if ($playerHand[0][1] == $playerHand[1][1]) {
                        array_push($this->actions, 'split');
                    }
                }
            }
        }

        $this->game->gameable->actions = $this->actions;

        return $this;
    }

    public function insurance($insurance = TRUE): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // load initially shuffled deck
        $this->deck->set(explode(',', $this->game->secret));

        $playerHand = explode(',', $this->game->gameable->player_hand);

        // if insurance requested
        if ($insurance) {
            // deduct insurance bet from user account
            $this->game->gameable->insurance_bet = $this->game->gameable->bet / 2;
            $this->adjustBet($this->game->gameable->insurance_bet);

            // if player has blackjack
            if ($this->game->gameable->player_score == 21 && $this->game->gameable->dealer_score != 21) {
                $this->game->gameable->player_blackjack = TRUE;
                $this->game->gameable->insurance_win = 0;
                $this->game->gameable->win = $this->game->gameable->bet * 3 / 2 + $this->game->gameable->bet; // blackjack pays 3/2
                $this->saveResult($this->game->gameable->win);
                // if dealer has blackjack
            } elseif ($this->game->gameable->player_score != 21 && $this->game->gameable->dealer_score == 21) {
                $this->game->gameable->dealer_blackjack = TRUE;
                $this->game->gameable->insurance_win = $this->game->gameable->insurance_bet * 2/1 + $this->game->gameable->insurance_bet; //insurance pays 2:1
                $this->saveResult($this->game->gameable->insurance_win);
                // if both player and dealer have blackjack
            } elseif ($this->game->gameable->player_score == 21 && $this->game->gameable->dealer_score == 21) {
                $this->game->gameable->player_blackjack = TRUE;
                $this->game->gameable->dealer_blackjack = TRUE;
                $this->game->gameable->insurance_win = $this->game->gameable->insurance_bet * 2/1 + $this->game->gameable->insurance_bet; //insurance pays 2:1
                $this->game->gameable->win = $this->game->gameable->bet; // return bet
                $this->saveResult($this->game->gameable->win + $this->game->gameable->insurance_win);
            }
        } else {
            // if player has blackjack
            if ($this->game->gameable->player_score == 21 && $this->game->gameable->dealer_score != 21) {
                $this->game->gameable->player_blackjack = TRUE;
                $this->game->gameable->win = $this->game->gameable->bet * 3 / 2 + $this->game->gameable->bet; // blackjack pays 3/2
                $this->saveResult($this->game->gameable->win);
                // if dealer has blackjack
            } elseif ($this->game->gameable->player_score != 21 && $this->game->gameable->dealer_score == 21) {
                $this->game->gameable->dealer_blackjack = TRUE;
                $this->saveResult(0);
                // if both player and dealer have blackjack
            } elseif ($this->game->gameable->player_score == 21 && $this->game->gameable->dealer_score == 21) {
                $this->game->gameable->player_blackjack = TRUE;
                $this->game->gameable->dealer_blackjack = TRUE;
                $this->game->gameable->win = $this->game->gameable->bet; // return bet
                $this->saveResult($this->game->gameable->win);
            }
        }

        if ($this->game->status == Game::STATUS_COMPLETED) {
            $this->game->gameable->makeVisible(['dealer_hand', 'dealer_score', 'dealer_blackjack']);
            array_push($this->actions, 'deal');
        } else {
            array_push($this->actions, 'hit', 'stand');
            // allow player to double the bet if user has sufficient funds
            if ($this->game->account->balance >= $this->game->gameable->bet) {
                array_push($this->actions, 'double');
                if ($playerHand[0][1] == $playerHand[1][1]) {
                    array_push($this->actions, 'split');
                }
            }
        }

        $this->game->gameable->actions = $this->actions;

        return $this;
    }

    /**
     * Hit one more card from the deck
     *
     * @return GameService
     * @throws \Exception
     */
    public function hit(): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // It's important to unset draw property, otherwise when hit() is called directly after deal()
        // Laravel will try to save actions property to DB and it will produce an exception.
        // This is relevant for bots feature.
        if (isset($this->game->gameable->actions))
            unset($this->game->gameable->actions);

        // load saved deck
        $this->deck->set(explode(',', $this->game->gameable->deck));

        $playerHand = explode(',', $this->game->gameable->player_hand);
        $dealerHand = explode(',', $this->game->gameable->dealer_hand);

        $playerHand[] = $this->deck->get(1, count($playerHand) + count($dealerHand))[0];

        $this->game->gameable->player_hand = implode(',', $playerHand);
        $this->game->gameable->player_score = $this->calculateScore($playerHand);

        if ($this->game->gameable->player_score > 21) {
            $this->saveResult(0);
            $this->game->gameable->makeVisible(['dealer_hand', 'dealer_score', 'dealer_blackjack']);
            array_push($this->actions, 'deal');
        } else {
            $this->game->gameable->save();
            array_push($this->actions, 'hit', 'stand');
        }

        $this->game->gameable->actions = $this->actions;

        return $this;
    }

    /**
     * Double the initial bet, hit one more card from the deck and finish the game
     *
     * @return GameService
     * @throws \Exception
     */
    public function double(): GameService
    {
        // double the bet
        $this->game->gameable->bet *= 2;

        // adjust the bet in the generic game, so necessary account transaction is created
        $this->adjustBet($this->game->bet);

        // get 1 more card
        $this->hit();

        // if player didn't bust then stand and complete the game
        if ($this->game->status != Game::STATUS_COMPLETED) {
            // unset custom actions attribute, so it doesn't throw an error when saving the model instance in stand() method
            unset($this->game->gameable->actions);
            $this->actions = [];
            $this->stand();
        }

        return $this;
    }

    /**
     * Stand (don't hit any cards and wait for the dealer to complete the game)
     *
     * @return GameService
     * @throws \Exception
     */
    public function stand(): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // It's important to unset draw property, otherwise when stand() is called directly after hit()
        // Laravel will try to save actions property to DB and it will produce an exception.
        // This is relevant for bots feature.
        if (isset($this->game->gameable->actions))
            unset($this->game->gameable->actions);

        // load saved deck
        $this->deck->set(explode(',', $this->game->gameable->deck));

        $playerHand = explode(',', $this->game->gameable->player_hand);
        $dealerHand = explode(',', $this->game->gameable->dealer_hand);

        // if user has blackjack, first dealer card is an ace and player declined to take insurance (hit stand)
        if ($dealerHand[0][1] == 'a' && count($playerHand) == 2 && count($dealerHand) == 2 && $this->game->gameable->player_score == 21)
            return $this->insurance(FALSE);

        while ($this->calculateScore($dealerHand) < 17) {
            $dealerHand[] = $this->deck->get(1, count($playerHand) + count($dealerHand))[0];
        }

        $this->game->gameable->dealer_hand = implode(',', $dealerHand);
        $this->game->gameable->dealer_score = $this->calculateScore($dealerHand);

        // if dealer busted player wins
        if ($this->game->gameable->dealer_score > 21 || $this->game->gameable->player_score > $this->game->gameable->dealer_score) {
            $this->game->gameable->win = $this->game->gameable->bet * 2; // win pays 1:1
            $this->saveResult($this->game->gameable->win);
        // score is equal
        } elseif ($this->game->gameable->player_score == $this->game->gameable->dealer_score) {
            $this->game->gameable->win = $this->game->gameable->bet; // return bet
            $this->saveResult($this->game->gameable->win);
        // otherwise dealer wins
        } else {
            $this->saveResult(0);
        }

        $this->game->gameable->makeVisible(['dealer_hand', 'dealer_score', 'dealer_blackjack']);
        array_push($this->actions, 'deal');

        $this->game->gameable->actions = $this->actions;

        return $this;
    }

    public function split(): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // load saved deck
        $this->deck->set(explode(',', $this->game->gameable->deck));

        $playerHand = explode(',', $this->game->gameable->player_hand);
        $newCards = $this->deck->get(2,4); // skip 4 cards and get 2 new cards, one for each hand

        // split hands
        $splitHand = [$playerHand[0], $newCards[0]];
        $splitHand2 = [$playerHand[1], $newCards[1]];

        $this->game->gameable->player_hand = implode(',', $splitHand);
        $this->game->gameable->player_score = $this->calculateScore($splitHand);
        $this->game->gameable->player_hand2 = implode(',', $splitHand2);
        $this->game->gameable->player_score2 = $this->calculateScore($splitHand2);
        $this->game->gameable->bet2 = $this->game->gameable->bet;
        $this->adjustBet($this->game->gameable->bet);

        if ($this->game->gameable->player_score < 21) {
            array_push($this->actions, 'splitHit');
            array_push($this->actions, 'splitStand');
        } elseif ($this->game->gameable->player_score2 < 21) {
            array_push($this->actions, 'splitHit2');
            array_push($this->actions, 'splitStand2');
        // both hands have 21 points
        } else {
            $this->splitStand();
        }

        $this->game->gameable->actions = $this->actions;

        return $this;
    }

    /**
     * Hit one more card from the deck
     *
     * @return GameService
     * @throws \Exception
     */
    public function splitHit(int $hand): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // load saved deck
        $this->deck->set(explode(',', $this->game->gameable->deck));

        $playerHand = explode(',', $this->game->gameable->player_hand);
        $playerHand2 = explode(',', $this->game->gameable->player_hand2);
        $dealerHand = explode(',', $this->game->gameable->dealer_hand);

        // hit new card
        $newCard = $this->deck->get(1, count($playerHand) + count($playerHand2) + count($dealerHand));

        if ($hand == 1) {
            $attrHand = 'player_hand';
            $attrScore = 'player_score';
            $cards = array_merge($playerHand, $newCard);
        } else {
            $attrHand = 'player_hand2';
            $attrScore = 'player_score2';
            $cards = array_merge($playerHand2, $newCard);
        }

        $this->game->gameable->$attrHand = implode(',', $cards);
        $this->game->gameable->$attrScore = $this->calculateScore($cards);
        $this->game->gameable->save();

        // 1st hand played - 1st hand NOT busted
        if ($hand == 1 && $this->game->gameable->player_score < 21) {
            array_push($this->actions, 'splitHit', 'splitStand');
        // 2nd hand played - both hands busted
        } elseif ($hand == 2 && $this->game->gameable->player_score > 21 && $this->game->gameable->player_score2 > 21) {
            $this->saveResult(0);
            $this->game->gameable->makeVisible(['dealer_hand', 'dealer_score', 'dealer_blackjack']);
            array_push($this->actions, 'deal');
        // 2nd hand played - only 2nd hand busted
        } elseif ($hand == 2 && $this->game->gameable->player_score2 > 21) {
            $this->splitStand($hand);
        } else {
            array_push($this->actions, 'splitHit2', 'splitStand2');
        }

        $this->game->gameable->actions = $this->actions;

        return $this;
    }

    /**
     * Stand (don't hit any cards and wait for the dealer to complete the game)
     *
     * @return GameService
     * @throws \Exception
     */
    public function splitStand(int $hand): GameService
    {
        if (!$this->game->gameable)
            throw new \Exception('Gameable model should be loaded first.');

        // load saved deck
        $this->deck->set(explode(',', $this->game->gameable->deck));

        if ($hand == 1) {
            array_push($this->actions, 'splitHit2', 'splitStand2');
        } else {
            $playerHand = explode(',', $this->game->gameable->player_hand);
            $playerHand2 = explode(',', $this->game->gameable->player_hand2);
            $dealerHand = explode(',', $this->game->gameable->dealer_hand);

            while ($this->calculateScore($dealerHand) < 17) {
                $dealerHand[] = $this->deck->get(1, count($playerHand) + count($playerHand2) + count($dealerHand))[0];
            }

            $this->game->gameable->dealer_hand = implode(',', $dealerHand);
            $this->game->gameable->dealer_score = $this->calculateScore($dealerHand);

            $win = 0;
            // 1st hand won
            if ($this->game->gameable->player_score <= 21 && ($this->game->gameable->dealer_score > 21 || $this->game->gameable->player_score > $this->game->gameable->dealer_score)) {
                $this->game->gameable->win = $this->game->gameable->bet * 2; // win pays 1:1
                $win += $this->game->gameable->win;
            }
            // 2nd hand won
            if ($this->game->gameable->player_score2 <= 21 && ($this->game->gameable->dealer_score > 21 || $this->game->gameable->player_score2 > $this->game->gameable->dealer_score)) {
                $this->game->gameable->win2 = $this->game->gameable->bet2 * 2; // win pays 1:1
                $win += $this->game->gameable->win2;
            }
            // 1st hand push
            if ($this->game->gameable->player_score <= 21 && $this->game->gameable->player_score == $this->game->gameable->dealer_score) {
                $this->game->gameable->win = $this->game->gameable->bet; // return bet
                $win += $this->game->gameable->win;
            }
            // 2nd hand push
            if ($this->game->gameable->player_score2 <= 21 && $this->game->gameable->player_score2 == $this->game->gameable->dealer_score) {
                $this->game->gameable->win2 = $this->game->gameable->bet2; // return bet
                $win += $this->game->gameable->win2;
            }
            // save game result
            $this->saveResult($win);

            $this->game->gameable->makeVisible(['dealer_hand', 'dealer_score', 'dealer_blackjack']);
            array_push($this->actions, 'deal');
        }

        $this->game->gameable->actions = $this->actions;

        return $this;
    }

    private function calculateScore(array $hand): float
    {
        // possible aces values depending on their number of occurances in the hand
        $acesOutcomes = [
            1 => [1, 11], // 1 Ace
            2 => [2, 12, 22], // 2 Aces
            3 => [3, 13, 23, 33], // 3 Aces
            4 => [4, 14, 24, 34, 44], // 4 Aces
        ];
        $acesCount = 0; // count of aces in the hand
        $score = 0;

        // calculate total score for all non aces cards first
        foreach ($hand as $card) {
            // if it's not an Ace
            if ($card[1] != 'a') {
                $score += intval($card[1]) ?: 10;
            // if it's an Ace
            } else {
                $acesCount++; // increment aces count
            }
        }

        // if there are aces in the hand
        if ($acesCount) {
            // loop through possible aces outcomes (each ace can be either 1 or 11)
            foreach ($acesOutcomes[$acesCount] as $i => $acesValue) {
                $currentScore = $score;
                if ($i==0 && $acesValue + $currentScore > 21) {
                    $currentScore += $acesValue;
                    break;
                } else if ($i > 0 && $acesValue + $currentScore > 21) {
                    $currentScore += $acesOutcomes[$acesCount][$i-1];
                    break;
                } else {
                    $currentScore += $acesValue;
                }
            }
            $score = $currentScore;
        }

        return $score;
    }
}