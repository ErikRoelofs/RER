<?php

namespace Plu\RerBundle\Repository;


use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Exception\CannotRemoveUnknownEntityException;
use Plu\RerBundle\Forge\EntityBlueprint;
use Plu\RerBundle\Forge\EntityForge;

class FileRepository implements RepositoryInterface
{

    /**
     * @var \Plu\RerBundle\Forge\EntityBlueprint
     */
    private $blueprint;

    /**
     * @var EntityForge
     */
    private $forge;

    private $location;

    private $items = array();

    private $loaded = false;

    public function __construct(EntityBlueprint $blueprint, EntityForge $forge, $location)
    {
        $this->location = $location;
        $this->blueprint = $blueprint;
        $this->forge = $forge;
    }

    public function count()
    {
        $this->loadAll();
        return count($this->items);
    }

    public function persist($entity)
    {
        $this->loadAll();
        $entity->uniq(rand(1, 100000));
        $this->items[] = $entity;
        $this->writeAll();
    }

    private function loadAll()
    {
        if (!$this->loaded) {
            $this->firstLoad();
        } else {
            $this->mapItems($this->getContent());
        }
    }

    private function firstLoad()
    {
        $this->items = $this->getContent();
        $this->loaded = true;
    }

    private function getContent()
    {
        if (file_exists($this->location)) {
            return unserialize(file_get_contents($this->location));
        }
        return array();
    }

    private function mapItems($items)
    {
        foreach ($items as $item) {
            $orig = $this->findOriginal($item->uniq());
            if (!$orig) {
                $this->items[] = $item;
            }
        }
    }

    private function findOriginal($uniq)
    {
        foreach ($this->items as $item) {
            if ($item->uniq() == $uniq) {
                return $item;
            }
        }
        return null;
    }

    private function writeAll()
    {
        file_put_contents($this->location, serialize($this->items));
    }

    public function remove($entity)
    {
        foreach ($this->items as $key => $item) {
            if ($item === $entity) {
                unset($this->items[$key]);
                $this->writeAll();
            }
            return true;
        }
        throw new CannotRemoveUnknownEntityException("Cannot remove unknown entity.");
    }

    public function getProtoEntity()
    {
        return $this->forge->makeProtoEntity($this->blueprint, $this);
    }

    public function newEntity()
    {
        return $this->forge->makeRealEntity($this->blueprint, $this);
    }

    public function searchFor(ProtoEntity $proto)
    {
        $this->loadAll();
        $hits = array();
        foreach ($this->items as $item) {
            if ($proto->matches($item)) {
                $hits[] = $item;
            }
        }
        return $hits;
    }

    public function update($entity)
    {
        $this->writeAll();
    }

} 