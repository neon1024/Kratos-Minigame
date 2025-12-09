<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\Kratos;
use App\Models\Monster;
use App\Repositories\Entities;

class Game
{
    private Entities $entities;
    private Kratos $kratos;
    private Monster $monster;
    private int $turn;
    private int $max_turns;

    public function start(): void {
        $this->initialize();

        // begin combat
        // first attacker is who has the highest speed, or luck if speeds are equal
        if($this->kratos->getSpeed() > $this->monster->getSpeed()) {
            $attacker = $this->kratos;
            $defender = $this->monster;
        } elseif($this->kratos->getSpeed() == $this->monster->getSpeed()) {
            if($this->kratos->getLuck() > $this->monster->getLuck()) {
                $attacker = $this->kratos;
                $defender = $this->monster;
            } else {
                $attacker = $this->monster;
                $defender = $this->kratos;
            }
        } else {
            $attacker = $this->monster;
            $defender = $this->kratos;
        }

        while($this->turn <= $this->max_turns) {
            // based on luck, the defender can dodge an attack
            $dodges = 0;

            if($this->dodgeTriggered($defender)) {
                $dodges++;
            }

            // use skills if present

            if($defender instanceof Kratos) {
                // check for triggered skills
            }

            $strikes = 0;

            if($attacker instanceof Kratos) {
                // check for triggered skills
            }

            // damage = attacker strength - defender defence
            if($dodges >= $strikes) {
                continue;
            } else {
                $damage = ($strikes - $dodges) * ($attacker->getStrength() - $defender->getDefence());
                $defender->setHealth($defender->getHealth() - $damage);
            }

            // switch roles
            $aux = $attacker;
            $attacker = $defender;
            $defender = $aux;

            // game ends after 15 turns or if one of the entities dies
            if($attacker->getHealth() <= 0 or $defender->getHealth() <= 0) {
                break;
            }

            $this->turn++;
        }

        // TODO show game results

        $this->reset();
    }

    private function initialize(): void {
        // create Kratos with random stats
        $this->createKratosRandom();

        // create Monster with random stats
        $this->createMonsterRandom();

        $this->turn = 1;
        $this->max_turns = 15;
    }

    private function createKratosRandom(): void {
        $this->entities->addEntity(Kratos::fromRandomStats());
    }

    private function createMonsterRandom(): void {
        $this->entities->addEntity(Monster::fromRandomStats());
    }

    private function dodgeTriggered(Entity $entity): bool {
        $dodge_chance = $entity->getLuck();
        $random_int = mt_rand(0, 100);

        return $random_int / 100.0 <= $dodge_chance;
    }

    private function reset(): void {
        $this->entities->removeEntities();
    }
}
