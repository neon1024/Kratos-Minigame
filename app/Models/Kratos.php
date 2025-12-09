<?php

namespace App\Models;

class Kratos extends Entity
{
    /** @var Skill[] */
    private array $skills;

    public function __construct(int $health, int $strength, int $defence, int $speed, float $luck)
    {
        parent::__construct($health, $strength, $defence, $speed, $luck);
    }

    public function getSkills(): array {
        return $this->skills;
    }

    public function setSkills(array $skills): void {
        $this->skills = $skills;
    }

    private function getRandomHealth(): int {
        // 65 - 100
        return 65;
    }

    private function getRandomStrength(): int {
        // 75 - 90
        return 75;
    }

    private function getRandomDefence(): int {
        // 40 - 50
        return 40;
    }

    private function getRandomSpeed(): int {
        // 40 - 50
        return 40;
    }

    private function getRandomLuck(): float {
        // 10% - 20%
        return 0.1;
    }

    public function fromRandomStats(): Kratos {
        $health = $this->getRandomHealth();
        $strength = $this->getRandomStrength();
        $defence = $this->getRandomDefence();
        $speed = $this->getRandomSpeed();
        $luck = $this->getRandomLuck();

        // TODO add skills

        return new Kratos($health, $strength, $defence, $speed, $luck);
    }
}
