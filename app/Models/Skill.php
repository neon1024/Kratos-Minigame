<?php

namespace App\Models;

class Skill
{
    private string $name;
    private string $description;
    private float $chance;
    private SkillType $skill_type;

    public function __construct(string $name, string $description, float $chance, SkillType $skill_type) {
        $this->name = $name;
        $this->description = $description;
        $this->chance = $chance;
        $this->skill_type = $skill_type;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getChance(): float {
        return $this->chance;
    }

    public function setChance(float $chance): void {
        $this->chance = $chance;
    }

    public function getSkillType(): SkillType {
        return $this->skill_type;
    }

    public function setSkillType(SkillType $skill_type): void {
        $this->skill_type = $skill_type;
    }
}
