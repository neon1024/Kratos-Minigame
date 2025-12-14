<?php

namespace Tests;

use App\Models\Kratos;
use App\Models\MagicArmour;
use App\Models\RapidFire;
use PHPUnit\Framework\TestCase;

class KratosTest extends TestCase
{
    public function testClassConstructor()
    {
        $health = 100;
        $strength = 100;
        $defence = 25;
        $speed = 50;
        $luck = 0.25;
        $skills = [RapidFire::fromDefaults(), MagicArmour::fromDefaults()];

        $kratos = new Kratos(
            $health,
            $strength,
            $defence,
            $speed,
            $luck,
            $skills);

        $this->assertSame($health, $kratos->getHealth());
        $this->assertSame($strength, $kratos->getStrength());
        $this->assertSame($defence, $kratos->getDefence());
        $this->assertSame($speed, $kratos->getSpeed());
        $this->assertSame($luck, $kratos->getLuck());
        $this->assertSame($skills, $kratos->getSkills());
    }

    public function testFromRandomStats()
    {
        $kratos = Kratos::fromRandomStats();

        $health = $kratos->getHealth();
        $strength = $kratos->getStrength();
        $defence = $kratos->getDefence();
        $speed = $kratos->getSpeed();
        $luck = $kratos->getLuck();
        $skills = $kratos->getSkills();

        $this->assertTrue($health >= 65 and $health <= 100);
        $this->assertTrue($strength >= 75 and $strength <= 90);
        $this->assertTrue($defence >= 40 and $defence <= 50);
        $this->assertTrue($speed >= 40 and $speed <= 50);
        $this->assertTrue($luck >= 0.1 and $luck <= 0.2);
        $this->assertEquals($skills, [RapidFire::fromDefaults(), MagicArmour::fromDefaults()]);
    }

    public function testAddSkill()
    {
        $kratos = Kratos::fromRandomStats();

        $this->assertTrue(count($kratos->getSkills()) == 2);

        $new_skill = RapidFire::fromDefaults();

        $kratos->addSkill($new_skill);

        $this->assertTrue(count($kratos->getSkills()) == 3);
    }
}
