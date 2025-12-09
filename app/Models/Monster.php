<?php

namespace App\Models;

class Monster extends Entity
{
    public function __construct(int $health, int $strength, int $defence, int $speed, float $luck)
    {
        parent::__construct($health, $strength, $defence, $speed, $luck);
    }

    private function getRandomHealth(): int {
        // 50 - 80
        return 50;
    }

    private function getRandomStrength(): int {
        // 55 - 80
        return 55;
    }

    private function getRandomDefence(): int {
        // 50 - 70
        return 50;
    }

    private function getRandomSpeed(): int {
        // 40 - 60
        return 40;
    }

    private function getRandomLuck(): float {
        // 30% - 45%
        return 0.3;
    }

    public function fromRandomStats(): Monster {
        $health = $this->getRandomHealth();
        $strength = $this->getRandomStrength();
        $defence = $this->getRandomDefence();
        $speed = $this->getRandomSpeed();
        $luck = $this->getRandomLuck();

        return new Monster($health, $strength, $defence, $speed, $luck);
    }
}
