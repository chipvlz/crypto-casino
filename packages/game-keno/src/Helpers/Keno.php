<?php

namespace Packages\GameKeno\Helpers;

use App\Helpers\Games\NumberGenerator;

class Keno
{
    private $numbers;
    private $drawCount;
    private $numberGenerator;

    public function __construct(int $ballsCount = 80)
    {
        $this->numbers = [];
        $this->drawCount = intval(config('game-keno.draw_count'));
        $this->numberGenerator = new NumberGenerator(1, $ballsCount);

        return $this;
    }


    /**
     * Draw random numbers
     *
     * @return Keno
     */
    public function drawNumbers(): Keno
    {
        while(count($this->numbers) < $this->drawCount) {
            $number = $this->numberGenerator->generate()->getNumber();
            if (!in_array($number, $this->numbers))
                $this->numbers[] = $number;
        }

        return $this;
    }

    /**
     * Shift each ball in balls generated earlier
     *
     * @param int $shift
     * @return Keno
     */
    public function shiftBalls(int $shift): Keno
    {
        foreach ($this->numbers as &$number) {
            $number = $this->numberGenerator->setNumber($number)->shift($shift)->getNumber();
        }

        return $this;
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    /**
     * Load numbers
     *
     * @param array $numbers
     * @return Keno
     */
    public function setNumbers(array $numbers): Keno
    {
        $this->numbers = $numbers;

        return $this;
    }
}