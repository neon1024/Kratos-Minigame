<?php

namespace Tests;

use App\Models\Entity;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testClassConstructor()
    {
        $health = 100;
        $strength = 100;
        $defence = 25;
        $speed = 50;
        $luck = 0.25;

        $entity = new Entity(
            $health,
            $strength,
            $defence,
            $speed,
            $luck
        );

        $this->assertSame($health, $entity->getHealth());
        $this->assertSame($strength, $entity->getStrength());
        $this->assertSame($defence, $entity->getDefence());
        $this->assertSame($speed, $entity->getSpeed());
        $this->assertEquals($luck, $entity->getLuck());
    }
}
