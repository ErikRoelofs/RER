<?php

namespace Plu\RerBundle\Forge;

// the forge has all the tools to modify blueprints, such as adding new fields, copying from other blueprints, removing, extending, etc
class EntityForge
{

    public function newBlueprint()
    {
        return new EntityBlueprint;
    }

    public function addField(EntityBlueprint $blueprint, $field)
    {
        $blueprint->addField($field);
    }

} 