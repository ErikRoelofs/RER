<?php

namespace Plu\RerBundle\Forge\Callback;

use Plu\RerBundle\Entity\CallbackRealEntity;
use Plu\RerBundle\Forge\EntityBlueprint;

class CallbackRealEntityFactory
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