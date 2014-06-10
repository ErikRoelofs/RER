<?php

namespace Plu\RerBundle\Repository;


use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Exception\CannotRemoveUnknownEntityException;
use Plu\RerBundle\Forge\EntityBlueprint;
use Plu\RerBundle\Forge\EntityForge;

class MemoryRepository implements RepositoryInterface
{

    private $contents = array();

    /**
     * @var \Plu\RerBundle\Forge\EntityBlueprint
     */
    private $blueprint;

    /**
     * @var EntityForge
     */
    private $forge;

    public function __construct(EntityBlueprint $blueprint, EntityForge $forge)
    {
        $this->blueprint = $blueprint;
        $this->forge = $forge;
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

    public function getProtoEntity()
    {
        return $this->forge->makeProtoEntity($this->blueprint);
    }

    public function newEntity()
    {
        return $this->forge->makeRealEntity($this->blueprint);
    }

    public function searchFor(ProtoEntity $proto)
    {
        $hits = array();
        foreach ($this->contents as $item) {
            if ($proto->matches($item)) {
                $hits[] = $item;
            }
        }
        return $hits;
    }

} 