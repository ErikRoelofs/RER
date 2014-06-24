<?php

namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Entity\ProtoEntity;

class ProtoEntityFactory
{

    public function convert(EntityBlueprint $blueprint)
    {
        $fields = $blueprint->getFields();
        $entity = new ProtoEntity();
        foreach ($fields as $field) {
            $entity->addField($field);
        }
        $entity->type($blueprint->getEntityName());
        return $entity;
    }

} 