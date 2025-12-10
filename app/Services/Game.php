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
            // defender

            $damage_multiplier = 1;

            // use skills if present
            if($defender instanceof Kratos) {
                // filter defence skills
                $defence_skills = array_filter(
                    $defender->getSkills(),
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
                    }
                }
            }

            // attacker
            $strikes = 1;

            if($attacker instanceof Kratos) {
                // filter attack skills
                $attack_skills = array_filter(
                    $attacker->getSkills(),
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
                    }
                }
            }

            $dodges = 0;

            for($try_to_dodge = 0; $try_to_dodge < $strikes; $try_to_dodge++) {
                if ($this->dodgeTriggered($defender)) {
                    $dodges++;
                }
            }

            // damage = attacker strength - defender defence
            $effective_strikes = max(0, $strikes - $dodges);
            $base_damage = max(0, $attacker->getStrength() - $defender->getDefence());
            $damage = $effective_strikes * $base_damage * $damage_multiplier;
            $defender->setHealth($defender->getHealth() - $damage);

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
        $this->kratos = Kratos::fromRandomStats();
    }

    private function createMonsterRandom(): void {
        $this->monster = Monster::fromRandomStats();
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
}
