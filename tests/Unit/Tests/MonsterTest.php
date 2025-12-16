<?php

namespace Tests;

use App\Models\Monster;
use PHPUnit\Framework\TestCase;

class MonsterTest extends TestCase
{
    public function testFromRandomStats()
    {
        $monster = Monster::fromRandomStats();

        // 50 - 80
        $health = $monster->getHealth();

        // 55 - 80
        $strength = $monster->getStrength();

        // 50 - 70
        $defence = $monster->getDefence();

        // 40 - 60
        $speed = $monster->getSpeed();

        // 30% - 45%
        $luck = $monster->getLuck();

        $this->assertTrue($health >= 50 and $health <= 80);
        $this->assertTrue($strength >= 55 and $strength <= 80);
        $this->assertTrue($defence >= 50 and $defence <= 70);
        $this->assertTrue($speed >= 40 and $speed <= 60);
        $this->assertTrue($luck >= 0.3 and $luck <= .45);
    }
}
