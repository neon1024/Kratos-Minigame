<?php

namespace App\Services;

use App\Models\Kratos;
use App\Models\Monster;
use App\Repositories\Entities;

class Game
{
    private Entities $entities;
    private int $max_turns;

    public function start(): void {
        // create Kratos with random stats
        $this->createKratosRandom();

        // create Monster with random stats
        $this->createMonsterRandom();

        $turn = 1;
        $max_turns = 15;

        // begin combat
        while($turn <= $max_turns) {
            break;
        }
        // first attacker is who has the highest speed, or luck if speeds are equal
        // use skills if present
        // damage = attacker strength - defender defence
        // based on luck, the defender can dodge an attack
        // game ends after 15 turns or if one of the entities dies
    }

    private function createKratosRandom(): void {
        $this->entities->addEntity(Kratos::fromRandomStats());
    }

    private function createMonsterRandom(): void {
        $this->entities->addEntity(Monster::fromRandomStats());
    }
}
