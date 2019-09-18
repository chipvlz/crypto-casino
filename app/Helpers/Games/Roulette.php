<?php

namespace App\Helpers\Games;

class Roulette
{
    const ROULETTE = [
        0,32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26
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
        $this->position = random_int(0, 36);

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
        $this->position = $this->position + $number < 37 ?
            $this->position + $number :
            ($this->position + $number) % 37;

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
        if ($position >= 0 && $position < 37)
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