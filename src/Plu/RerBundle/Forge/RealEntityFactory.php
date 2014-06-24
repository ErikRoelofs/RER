<?php

namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Entity\RealEntity;
use Plu\RerBundle\Repository\RepositoryInterface;

class RealEntityFactory
{

    public function convert(EntityBlueprint $blueprint, RepositoryInterface $repo)
    {
        $fields = $blueprint->getFields();
        $entity = new RealEntity();
        foreach ($fields as $field) {
            $entity->addField($field);
        }
        $entity->type($blueprint->getEntityName());
        return $entity;
    }

} 