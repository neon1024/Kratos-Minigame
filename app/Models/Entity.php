<?php

namespace App\Models;

class Entity
{
    protected int $health;
    protected int $strength;
    protected int $defence;
    protected int $speed;
    protected float $luck;

    public function __construct(int $health, int $strength, int $defence, int $speed, float $luck) {
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
    }

    public function getHealth(): int {
        return $this->health;
    }

    public function setHealth(int $health): void {
        $this->health = $health;
    }

    public function getStrength(): int {
        return $this->strength;
    }

    public function setStrength(int $strength): void {
        $this->strength = $strength;
    }

    public function getDefence(): int {
        return $this->defence;
    }

    public function setDefence(int $defence): void {
        $this->defence = $defence;
    }

    public function getSpeed(): int {
        return $this->speed;
    }

    public function setSpeed(int $speed): void {
        $this->speed = $speed;
    }

    public function getLuck(): float {
        return $this->luck;
    }

    public function setLuck(float $luck): void {
        $this->luck = $luck;
    }
}
