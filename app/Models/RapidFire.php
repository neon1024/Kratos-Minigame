<?php

namespace App\Models;

class RapidFire extends Skill
{
    public static function fromDefaults(): self {
        return new self(
            "Rapid Fire",
            "Strike twice while it's his turn to attack. There's a 15% chance he'll use this skill every time he attacks",
            0.15,
            SkillType::Attack
        );
    }

    public function activate(): void {
        // check if the skill is used based on its chance
    }
}
