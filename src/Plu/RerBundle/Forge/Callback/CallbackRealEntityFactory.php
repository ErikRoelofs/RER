<?php

namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Entity\CallbackRealEntity;

class RealEntityFactory
{

    public function convert(EntityBlueprint $blueprint, $repo)
    {
        $fields = $blueprint->getFields();
        $entity = new CallbackRealEntity($repo);
        foreach ($fields as $field) {
            $entity->addField($field);
        }
        return $entity;
    }

} 