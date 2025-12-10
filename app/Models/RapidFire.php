<?php

namespace App\Models;

class RapidFire extends Skill
{
    private int $strikes;

    public function __construct(string $name, string $description, float $chance, SkillType $skill_type, SkillEffectType $skill_effect_type, int $strikes)
    {
        parent::__construct($name, $description, $chance, $skill_type, $skill_effect_type);

        $this->strikes = $strikes;
    }

    public static function fromDefaults(): self {
        return new self(
            "Rapid Fire",
            "Strike twice while it's his turn to attack. There's a 15% chance he'll use this skill every time he attacks",
            0.15,
            SkillType::Attack,
            SkillEffectType::MultipleStrikes,
            2
        );
    }

    public function getStrikes(): int {
        return $this->strikes;
    }

    public function setStrikes(int $strikes): void {
        $this->strikes = $strikes;
    }

    public function getSkillEffectPower(): int {
        return $this->strikes;
    }
}
