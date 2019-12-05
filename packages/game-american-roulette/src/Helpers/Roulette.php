<?php

namespace Packages\GameAmericanRoulette\Helpers;

class Roulette
{
    const ROULETTE = [
        // 37 = 00
        0,28,9,26,30,11,7,20,32,17,5,22,34,15,3,24,36,13,1,37,27,10,25,29,12,8,19,31,18,6,21,33,16,4,23,35,14,2
    ];

    // roulette ball position (index)
    private $position;

    public function __construct()
    {
        $this->position = 0;

        return $this;
    }

    /**
     * Spin the roulette wheel
     *
     * @return Roulette
     */
    public function spin(): Roulette
    {
        $this->position = random_int(0, 37);

        return $this;
    }

    /**
     * Shift roulette position by a specific number
     *
     * @param array $shifts
     * @return Roulette
     */
    public function shift(int $number): Roulette
    {
        $this->position = $this->position + $number < 38 ?
            $this->position + $number :
            ($this->position + $number) % 38;

        return $this;
    }

    /**
     * Return current roulette ball position
     *
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Set current roulette ball position
     *
     * @param int $position
     * @return Roulette
     */
    public function setPosition(int $position): Roulette
    {
        if ($position >= 0 && $position < 38)
            $this->position = $position;

        return $this;
    }

    /**
     * Get the number at the specific position
     *
     * @return int
     */
    public function getNumber(): int
    {
        return self::ROULETTE[$this->getPosition()];
    }
}
