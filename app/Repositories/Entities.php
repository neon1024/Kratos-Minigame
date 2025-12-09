<?php

namespace App\Repositories;

use App\Models\Entity;

class Entities
{
    /** @var Entity[] */
    private array $entities;

    public function getEntities(): array {
        return $this->entities;
    }

    public function setEntities(array $entities): void {
        $this->entities = $entities;
    }

    public function addEntity(Entity $entity): void {
        $this->entities[] = $entity;
    }
}
