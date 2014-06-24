<?php

namespace Plu\RerBundle\Entity;

use Plu\RerBundle\Repository\RepositoryInterface;

class EntityIdentifier
{

    private $uniq;
    private $repo;

    public function __construct($entity, RepositoryInterface $repo)
    {
        $this->uniq = $entity->uniq();
        $this->repo = $repo;
    }

    public function getEntity()
    {
        return $this->repo->byUniq($this->uniq);
    }

}