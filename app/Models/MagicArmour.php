<?php

namespace App\Models;

class MagicArmour extends Skill
{
    private float $multiplier;

    public function __construct(string $name, string $description, float $chance, SkillType $skill_type, SkillEffectType $skill_effect_type, float $multiplier)
    {
        parent::__construct($name, $description, $chance, $skill_type, $skill_effect_type);

        $this->multiplier = $multiplier;
    }

    public static function fromDefaults(): self {
        return new self(
            "Magic Armour",
            "Takes only half of the usual damage when an enemy attacks. There's a 15% chance he'll use this skill every time he defends",
            0.15,
            SkillType::Defence,
            SkillEffectType::DamageReduction,
            0.5
        );
    }

    public function getMultiplier(): float {
        return $this->multiplier;
    }

    public function setMultiplier(float $multiplier): void {
        $this->multiplier = $multiplier;
    }

    public function getSkillEffectPower(): float {
        return $this->multiplier;
    }
}
