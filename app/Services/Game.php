<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\Kratos;
use App\Models\Monster;
use App\Models\Skill;
use App\Models\SkillEffectType;
use App\Models\SkillType;

class Game
{
    private Entity $attacker;
    private Entity $defender;
    private int $turn;
    private int $max_turns;
    private ?Entity $winner = null;
    private array $turns;

    public function start(): void {
        $this->initialize();

        // begin combat
        // first attacker is who has the highest speed, or luck if speeds are equal
        if($this->attacker->getSpeed() < $this->defender->getSpeed()) {
            $this->swapRoles();
        } elseif($this->attacker->getSpeed() == $this->defender->getSpeed()) {
            if($this->attacker->getLuck() < $this->defender->getLuck()) {
                $this->swapRoles();
            }
        }

        while($this->turn <= $this->max_turns) {
            $skills_used = [];

            // defender
            $damage_multiplier = 1;

            // use skills if present
            if($this->defender instanceof Kratos) {
                // filter defence skills
                $defence_skills = array_filter(
                    $this->defender->getSkills(),
                    function(Skill $skill) {
                        return $skill->getSkillType() == SkillType::Defence;
                    });

                // check for triggered skills
                foreach($defence_skills as /** @var Skill $skill */ $skill) {
                    if($this->skillTriggered($skill)) {
                        // apply the skill effect
                        switch($skill->getSkillEffectType()) {
                            case SkillEffectType::DamageReduction:
                                $damage_multiplier *= $skill->getSkillEffectPower();
                                break;
                            default:
                                break;
                        }

                        $skills_used[] = $skill->getName();
                    }
                }
            }

            // attacker
            $strikes = 1;

            if($this->attacker instanceof Kratos) {
                // filter attack skills
                $attack_skills = array_filter(
                    $this->attacker->getSkills(),
                    function(Skill $skill) {
                        return $skill->getSkillType() == SkillType::Attack;
                    });

                // check for triggered skills
                foreach($attack_skills as /** @var Skill $skill */ $skill) {
                    if($this->skillTriggered($skill)) {
                        // apply the skill effect
                        switch($skill->getSkillEffectType()) {
                            case SkillEffectType::MultipleStrikes:
                                if($strikes > 1) {
                                    $strikes += $skill->getSkillEffectPower();
                                } else {
                                    $strikes = $skill->getSkillEffectPower();
                                }
                                break;
                            default:
                                break;
                        }

                        $skills_used[] = $skill->getName();
                    }
                }
            }

            $dodges = 0;

            for($try_to_dodge = 0; $try_to_dodge < $strikes; $try_to_dodge++) {
                if ($this->dodgeTriggered($this->defender)) {
                    $dodges++;
                }
            }

            $attacker_health_start = $this->attacker->getHealth();
            $defender_health_start = $this->defender->getHealth();

            // damage = attacker strength - defender defence
            $effective_strikes = max(0, $strikes - $dodges);
            $base_damage = max(0, $this->attacker->getStrength() - $this->defender->getDefence());
            $damage = $effective_strikes * $base_damage * $damage_multiplier;
            $this->defender->setHealth($this->defender->getHealth() - $damage);

            $attacker_name = $this->attacker instanceof Kratos ? 'Kratos' : 'Monster';
            $defender_name = $this->defender instanceof Kratos ? 'Kratos' : 'Monster';

            $turn_data = [
                'turn' => $this->turn,
                'attacker_name' => $attacker_name,
                'defender_name' => $defender_name,
                'attacker_health_start' => $attacker_health_start,
                'defender_health_start' => $defender_health_start,
                'skills_used' => $skills_used,
                'dodges' => $dodges,
                'strikes' => $strikes,
                'damage' => $damage,
                'attacker_health_end' => $this->attacker->getHealth(),
                'defender_health_end' => $this->defender->getHealth(),
            ];

            $this->turns[] = $turn_data;

            // game ends after 15 turns or if one of the entities dies
            if($this->attacker->getHealth() <= 0) {
                $this->winner = $this->defender;
                break;
            } elseif($this->defender->getHealth() <= 0) {
                $this->winner = $this->attacker;
                break;
            } else {
                // continue the game
                $this->turn++;

                // swap roles if game continues
                if($this->turn <= $this->max_turns) {
                    $this->swapRoles();
                }
            }
        }
    }

    private function initialize(): void {
        // assume attacker is Kratos
        // create Kratos with random stats
        $this->attacker = $this->createKratosRandom();

        // assume defender is Monster
        // create Monster with random stats
        $this->defender = $this->createMonsterRandom();

        $this->turn = 1;
        $this->max_turns = 15;

        $this->turns = [];
    }

    private function createKratosRandom(): Kratos {
        return Kratos::fromRandomStats();
    }

    private function createMonsterRandom(): Monster {
        return Monster::fromRandomStats();
    }

    private function swapRoles(): void {
        $aux = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $aux;
    }

    private function dodgeTriggered(Entity $entity): bool {
        $dodge_chance = $entity->getLuck();
        $random_int = mt_rand(0, 100);

        return $random_int / 100.0 <= $dodge_chance;
    }

    private function skillTriggered(Skill $skill): bool {
        $chance = $skill->getChance();
        $random_int = mt_rand(0, 100);

        return $random_int / 100.0 <= $chance;
    }

    public function getResults(): array {
        if ($this->winner instanceof Kratos) {
            $message = "Kratos wins in $this->turn turns!";
        } elseif ($this->winner instanceof Monster) {
            $message = "Monster wins in $this->turn turns!";
        } else {
            $message = "Tie! Maximum number of turns exceeded.";
        }

        return [
            'message' => $message,
            'turns' => $this->turns
        ];
    }
}
