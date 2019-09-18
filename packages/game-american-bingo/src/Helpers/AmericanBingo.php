<?php

namespace Packages\GameAmericanBingo\Helpers;

use App\Helpers\Games\NumberGenerator;
use Packages\GameAmericanBingo\Models\GameAmericanBingo;

class AmericanBingo
{
    private $card;
    private $balls;
    private $numberGenerator;
    private $winPatterns;
    private $winCombinations;

    public function __construct(int $ballsCount = 75)
    {
        $this->balls = [];
        $this->card = [];
        $this->winPatterns = [];
        $this->winCombinations = [];
        $this->numberGenerator = new NumberGenerator(1, $ballsCount);

        return $this;
    }

    /**
     * Generate bingo card (24 numbers)
     *
     * @return AmericanBingo
     */
    public function generateCard(): AmericanBingo
    {
        foreach ([5, 5, 4, 5, 5] as $i => $count) {
            $numbers = [];
            $ng = new NumberGenerator($i*15 + 1, ($i+1)*15); // 1-15, 16-30, 31-45, 46-60, 61-75

            while(count($numbers) < $count) {
                $number = $ng->generate()->getNumber();
                if (!in_array($number, $numbers))
                    $numbers[] = $number;
            }

            $this->card = array_merge($this->card, $numbers);
        }

        return $this;
    }

    /**
     * Draw balls
     *
     * @param int $drawCount
     * @return AmericanBingo
     */
    public function drawBalls($drawCount = 35): AmericanBingo
    {
        while(count($this->balls) < $drawCount) {
            $ball = $this->numberGenerator->generate()->getNumber();
            if (!in_array($ball, $this->balls))
                $this->balls[] = $ball;
        }

        return $this;
    }

    /**
     * Shift each ball in balls generated earlier
     *
     * @param int $shift
     * @return AmericanBingo
     */
    public function shiftBalls(int $shift): AmericanBingo
    {
        foreach ($this->balls as &$ball) {
            $ball = $this->numberGenerator->setNumber($ball)->shift($shift)->getNumber();
        }

        return $this;
    }

    public function getBalls(): array
    {
        return $this->balls;
    }

    /**
     * Load balls
     *
     * @param array $balls
     * @return AmericanBingo
     */
    public function setBalls(array $balls): AmericanBingo
    {
        $this->balls = $balls;

        return $this;
    }

    public function getCardColumns(): array
    {
        if (empty($this->card))
            return [];

        $columns = [];
        for ($i=0; $i<5; $i++) {
            $offset = $i<=2 ? $i*5 : $i*5-1;
            $length = $i!=2 ? 5 : 4;
            $columns[] = array_slice($this->card, $offset, $length);
        }

        return $columns;
    }

    public function getCardRows(): array
    {
        if (empty($this->card))
            return [];

        $rows = [];
        for ($i=0; $i<5; $i++) {
            $rows[$i] = array_values(array_filter($this->card, function($k) use($i) {
                $n = $k<=11 ? $k : $k+1;
                return $n % 5 == $i;
            }, ARRAY_FILTER_USE_KEY));
        }

        return $rows;
    }

    public function getCardDiagonals(): array
    {
        if (empty($this->card))
            return [];

        return [
            [
                $this->card[0],
                $this->card[6],
                $this->card[17],
                $this->card[23],
            ],
            [
                $this->card[4],
                $this->card[8],
                $this->card[15],
                $this->card[19],
            ],
        ];
    }

    public function getCardCross(): array
    {
        if (empty($this->card))
            return [];

        return array_merge(...$this->getCardDiagonals());
    }

    public function getCard(): array
    {
        return $this->card;
    }

    public function getWinPatterns(): array
    {
        return $this->winPatterns;
    }

    public function getWinCombinations(): array
    {
        return $this->winCombinations;
    }

    public function run(): AmericanBingo
    {
        $patterns = [
            GameAmericanBingo::PATTERN_COLUMN => $this->getCardColumns(),
            GameAmericanBingo::PATTERN_ROW => $this->getCardRows(),
            GameAmericanBingo::PATTERN_DIAGONAL => $this->getCardDiagonals(),
            GameAmericanBingo::PATTERN_CROSS => $this->getCardCross(),
        ];

        foreach ($patterns as $pattern => $ballGroups) {
            // make a multi-dimensional array if ball groups is a flat array
            if (!isset($ballGroups[0][0]))
                $ballGroups = [$ballGroups];

            foreach ($ballGroups as $balls) {
                if (array_intersect($balls, $this->balls) == $balls) {
                    $this->winPatterns[] = $pattern;
                    $this->winCombinations[] = $balls;
                }
            }
        }

        return $this;
    }
}