<?php

namespace Packages\GameAmericanRoulette\Services;

use Packages\GameAmericanRoulette\Helpers\Roulette;
use App\Services\GameService;
use Illuminate\Database\Eloquent\Model;
use Packages\GameAmericanRoulette\Models\GameAmericanRoulette;

class GameAmericanRouletteService extends GameService
{
    const BET_TYPES = [
        'red'           => [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36],
        'black'         => [2,4,6,8,10,11,13,15,17,20,22,24,26,28,29,31,33,35],
        'odd'           => [1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35],
        'even'          => [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36],
        'low'           => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
        'high'          => [19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36],
        'top_line'      => [0,1,2,3,37],
        'trio12'        => [0,1,2],
        'trio23'        => [2,3,37],
        'trio2'         => [0,2,37],
        'dozen1'        => [1,2,3,4,5,6,7,8,9,10,11,12],
        'dozen2'        => [13,14,15,16,17,18,19,20,21,22,23,24],
        'dozen3'        => [25,26,27,28,29,30,31,32,33,34,35,36],
        'column1'       => [1,4,7,10,13,16,19,22,25,28,31,34],
        'column2'       => [2,5,8,11,14,17,20,23,26,29,32,35],
        'column3'       => [3,6,9,12,15,18,21,24,27,30,33,36],
        'sixline1'      => [1,2,3,4,5,6],
        'sixline4'      => [4,5,6,7,8,9],
        'sixline7'      => [7,8,9,10,11,12],
        'sixline10'     => [10,11,12,13,14,15],
        'sixline13'     => [13,14,15,16,17,18],
        'sixline16'     => [16,17,18,19,20,21],
        'sixline19'     => [19,20,21,22,23,24],
        'sixline22'     => [22,23,24,25,26,27],
        'sixline25'     => [25,26,27,28,29,30],
        'sixline28'     => [28,29,30,31,32,33],
        'sixline31'     => [31,32,33,34,35,36],
        'street1'       => [1,2,3],
        'street4'       => [4,5,6],
        'street7'       => [7,8,9],
        'street10'      => [10,11,12],
        'street13'      => [13,14,15],
        'street16'      => [16,17,18],
        'street19'      => [19,20,21],
        'street22'      => [22,23,24],
        'street25'      => [25,26,27],
        'street28'      => [28,29,30],
        'street31'      => [31,32,33],
        'street34'      => [34,35,36],
        'corner1'       => [1,2,4,5],
        'corner2'       => [2,3,5,6],
        'corner4'       => [4,5,7,8],
        'corner5'       => [5,6,8,9],
        'corner7'       => [7,8,10,11],
        'corner8'       => [8,9,11,12],
        'corner10'      => [10,11,13,14],
        'corner11'      => [11,12,14,15],
        'corner13'      => [13,14,16,17],
        'corner14'      => [14,15,17,18],
        'corner16'      => [16,17,18,19],
        'corner17'      => [17,18,20,21],
        'corner19'      => [19,20,22,23],
        'corner20'      => [20,21,23,24],
        'corner22'      => [22,23,25,26],
        'corner23'      => [23,24,26,27],
        'corner25'      => [25,26,28,29],
        'corner26'      => [26,27,29,30],
        'corner28'      => [28,29,31,32],
        'corner29'      => [29,30,32,33],
        'corner31'      => [31,32,34,35],
        'corner32'      => [32,33,35,36],
        'split1_2'      => [1,2],
        'split2_3'      => [2,3],
        'split4_5'      => [4,5],
        'split5_6'      => [5,6],
        'split7_8'      => [7,8],
        'split8_9'      => [8,9],
        'split10_11'    => [10,11],
        'split11_12'    => [11,12],
        'split13_14'    => [13,14],
        'split14_15'    => [14,15],
        'split16_17'    => [16,17],
        'split17_18'    => [17,18],
        'split19_20'    => [19,20],
        'split20_21'    => [20,21],
        'split22_23'    => [22,23],
        'split23_24'    => [23,24],
        'split25_26'    => [25,26],
        'split26_27'    => [26,27],
        'split28_29'    => [28,29],
        'split29_30'    => [29,30],
        'split31_32'    => [31,32],
        'split32_33'    => [32,33],
        'split34_35'    => [34,35],
        'split35_36'    => [35,36],
        'split1_4'      => [1,4],
        'split4_7'      => [4,7],
        'split7_10'     => [7,10],
        'split10_13'    => [10,13],
        'split13_16'    => [13,16],
        'split16_19'    => [16,19],
        'split19_22'    => [19,22],
        'split22_25'    => [22,25],
        'split25_28'    => [25,28],
        'split28_31'    => [28,31],
        'split31_34'    => [31,34],
        'split2_5'      => [2,5],
        'split5_8'      => [5,8],
        'split8_11'     => [8,11],
        'split11_14'    => [11,14],
        'split14_17'    => [14,17],
        'split17_20'    => [17,20],
        'split20_23'    => [20,23],
        'split23_26'    => [23,26],
        'split26_29'    => [26,29],
        'split29_32'    => [29,32],
        'split32_35'    => [32,35],
        'split3_6'      => [3,6],
        'split6_9'      => [6,9],
        'split9_12'     => [9,12],
        'split12_15'    => [12,15],
        'split15_18'    => [15,18],
        'split18_21'    => [18,21],
        'split21_24'    => [21,24],
        'split24_27'    => [24,27],
        'split27_30'    => [27,30],
        'split30_33'    => [30,33],
        'split33_36'    => [33,36],
        'straight0'     => [0],
        'straight00'    => [37],
        'straight1'     => [1],
        'straight2'     => [2],
        'straight3'     => [3],
        'straight4'     => [4],
        'straight5'     => [5],
        'straight6'     => [6],
        'straight7'     => [7],
        'straight8'     => [8],
        'straight9'     => [9],
        'straight10'    => [10],
        'straight11'    => [11],
        'straight12'    => [12],
        'straight13'    => [13],
        'straight14'    => [14],
        'straight15'    => [15],
        'straight16'    => [16],
        'straight17'    => [17],
        'straight18'    => [18],
        'straight19'    => [19],
        'straight20'    => [20],
        'straight21'    => [21],
        'straight22'    => [22],
        'straight23'    => [23],
        'straight24'    => [24],
        'straight25'    => [25],
        'straight26'    => [26],
        'straight27'    => [27],
        'straight28'    => [28],
        'straight29'    => [29],
        'straight30'    => [30],
        'straight31'    => [31],
        'straight32'    => [32],
        'straight33'    => [33],
        'straight34'    => [34],
        'straight35'    => [35],
        'straight36'    => [36],
    ];

    protected $gameableModel = GameAmericanRoulette::class;

    private $roulette;

    public function __construct($user = NULL)
    {
        parent::__construct($user);
        $this->roulette = new Roulette();
    }

    protected function createGameable(): Model
    {
        $gameable = new GameAmericanRoulette();
        $gameable->position = 0;
        $gameable->save();

        return $gameable;
    }

    protected function makeSecret(): string
    {
        return $this->roulette->spin()->getPosition();
    }

    protected function adjustSecret(): string
    {
        return $this->roulette->shift($this->game->shift_value)->getPosition();
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

        // load initial roulette position
        $this->roulette->setPosition($this->game->secret);

        $this->game->gameable->position = $this->adjustSecret(); // shift roulette by N random positions
        $this->game->gameable->bets = implode(',', $this->getBetsList($params['bets']));
        $this->game->gameable->wins = implode(',', $this->getWinBetsList($params['bets'], $this->roulette->getNumber()));

        // complete the game
        $this->complete($this->calcBetAmount($params['bets']), $this->calcWinAmount($params['bets'], $this->roulette->getNumber()));

        // append extra attributes to JSON
        $this->game->gameable->number = $this->roulette->getNumber();

        return $this;
    }

    /**
     * Calculate total bet amount
     *
     * @param $bets
     * @return int
     */
    public static function calcBetAmount($bets): int
    {
        return array_sum(array_values($bets));
    }

    /**
     * Check if supplied bets are valid
     *
     * @param $bets
     * @return bool
     */
    public static function betsAreValid($bets)
    {
        foreach (array_keys($bets) as $type) {
            if (!isset(self::BET_TYPES[$type]))
                return FALSE;
        }

        return TRUE;
    }

    /**
     * Calculate total win amount
     *
     * @param $bets
     * @param $winNumber
     * @return int
     */
    private function calcWinAmount($bets, $winNumber): int
    {
        $amount = 0;

        foreach ($bets as $type => $bet) {
            if (in_array($winNumber, self::BET_TYPES[$type])) {
                $amount += $type == 'top_line'
                    ? $bet * 7 // special case, top line in american roulette pays 6:1
                    : $bet * (36 / count(self::BET_TYPES[$type]));
            }
        }

        return $amount;
    }

    /**
     * Get list of bets made
     *
     * @param $bets
     * @return array
     */
    private function getBetsList($bets): array
    {
        return array_map(function($type, $amount) {
            return $type . ':' . $amount;
        }, array_keys($bets), $bets);
    }

    /**
     * Get list of winning bets
     *
     * @param $bets
     * @param $winNumber
     * @return array
     */
    private function getWinBetsList($bets, $winNumber): array
    {
        $result = [];

        foreach (array_keys($bets) as $type) {
            if (in_array($winNumber, self::BET_TYPES[$type])) {
                $result[] = $type;
            }
        }

        return $result;
    }
}
