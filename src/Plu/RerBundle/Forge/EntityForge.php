<?php

namespace Plu\RerBundle\Forge;

// the forge has all the tools to modify blueprints, such as adding new fields, copying from other blueprints, removing, extending, etc
class EntityForge
{

    private $protoFactory;

    public function __construct(ProtoEntityFactory $factory)
    {
        $this->protoFactory = $factory;
    }


    public function newBlueprint()
    {
        return new EntityBlueprint;
    }

    public function addField(EntityBlueprint $blueprint, $field)
    {
        $blueprint->addField($field);
    }

    public function makeProtoEntity(EntityBlueprint $blueprint)
    {

    }

} 