<?php

namespace App\Models;

class Kratos extends Entity
{
    /** @var Skill[] */
    private array $skills;

    public function __construct(int $health, int $strength, int $defence, int $speed, float $luck, array $skills)
    {
        parent::__construct($health, $strength, $defence, $speed, $luck);
        $this->skills = $skills;
    }

    public function getSkills(): array {
        return $this->skills;
    }

    public function setSkills(array $skills): void {
        $this->skills = $skills;
    }

    public function addSkill(Skill $skill): void {
        $this->skills[] = $skill;
    }

    private static function getRandomHealth(): int {
        // 65 - 100
        return rand(65, 100);
    }

    private static function getRandomStrength(): int {
        // 75 - 90
        return rand(75, 90);
    }

    private static function getRandomDefence(): int {
        // 40 - 50
        return rand(40, 50);
    }

    private static function getRandomSpeed(): int {
        // 40 - 50
        return rand(40, 50);
    }

    private static function getRandomLuck(): float {
        // 10% - 20%
        $random_int = rand(10, 20);

        return $random_int / 100.0;
    }

    public static function fromRandomStats(): self {
        $health = self::getRandomHealth();
        $strength = self::getRandomStrength();
        $defence = self::getRandomDefence();
        $speed = self::getRandomSpeed();
        $luck = self::getRandomLuck();
        $skills = [RapidFire::fromDefaults(), MagicArmour::fromDefaults()];

        return new self($health, $strength, $defence, $speed, $luck, $skills);
    }
}
