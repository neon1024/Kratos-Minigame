<?php

namespace App\Models;

class Monster extends Entity
{
    private static function getRandomHealth(): int {
        // 50 - 80
        return rand(50, 80);
    }

    private static function getRandomStrength(): int {
        // 55 - 80
        return rand(55, 80);
    }

    private static function getRandomDefence(): int {
        // 50 - 70
        return rand(50, 70);
    }

    private static function getRandomSpeed(): int {
        // 40 - 60
        return rand(40, 60);
    }

    private static function getRandomLuck(): float {
        // 30% - 45%
        $random_int = rand(30, 45);

        return $random_int / 100.0;
    }

    public static function fromRandomStats(): self {
        $health = self::getRandomHealth();
        $strength = self::getRandomStrength();
        $defence = self::getRandomDefence();
        $speed = self::getRandomSpeed();
        $luck = self::getRandomLuck();

        return new self($health, $strength, $defence, $speed, $luck);
    }
}
