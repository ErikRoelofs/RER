<?php

namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Entity\RealEntity;

class RealEntityFactory
{

    public function convert(EntityBlueprint $blueprint)
    {
        $fields = $blueprint->getFields();
        $entity = new RealEntity();
        foreach ($fields as $field) {
            $entity->addField($field);
        }
        return $entity;
    }

} 