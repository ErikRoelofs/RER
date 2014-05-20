<?php

namespace Plu\RerBundle\Repository;


class MemoryRepository implements RepositoryInterface
{

    private $contents = array();

    public function count()
    {
        return count($this->contents);
    }

    public function persist($entity)
    {
        $this->contents[] = $entity;
    }

} 