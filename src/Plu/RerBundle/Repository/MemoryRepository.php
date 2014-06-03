<?php

namespace Plu\RerBundle\Repository;


use Plu\RerBundle\Exception\CannotRemoveUnknownEntityException;
use Plu\RerBundle\Forge\EntityBlueprint;

class MemoryRepository implements RepositoryInterface
{

    private $contents = array();

    private $blueprint;

    public function __construct(EntityBlueprint $blueprint)
    {
        $this->blueprint = $blueprint;
    }

    public function count()
    {
        return count($this->contents);
    }

    public function persist($entity)
    {
        $this->contents[] = $entity;
    }

    public function remove($entity)
    {
        $offset = $this->offset($entity);
        if ($offset === null) {
            throw new CannotRemoveUnknownEntityException("Cannot remove unknown entity.");
        }
        unset($this->contents[$offset]);

    }

    private function offset($entity)
    {
        foreach ($this->contents as $index => $row) {
            if ($entity == $row) {
                return $index;
            }
        }
        return null;
    }

} 