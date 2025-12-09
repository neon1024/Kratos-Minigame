<?php

namespace App\Models;

class MagicArmour extends Skill
{
    public static function fromDefaults(): self {
        return new self(
            "Magic Armour",
            "Takes only half of the usual damage when an enemy attacks. There's a 15% chance he'll use this skill every time he defends",
            0.15,
            SkillType::Defence
        );
    }

    public function activate(): void {
        // check if the skill is used based on its chance
    }
}
