<?php

namespace Plu\RerBundle\Forge;

// the forge has all the tools to modify blueprints, such as adding new fields, copying from other blueprints, removing, extending, etc
use Plu\RerBundle\Repository\RepositoryInterface;

class EntityForge
{

    /**
     * @var ProtoEntityFactory
     */
    private $protoFactory;

    /**
     * @var RealEntityFactory
     */
    private $realFactory;

    public function __construct(ProtoEntityFactory $pFactory, RealEntityFactory $rFactory)
    {
        $this->protoFactory = $pFactory;
        $this->realFactory = $rFactory;
    }

    public function newBlueprint()
    {
        return new EntityBlueprint;
    }

    public function addField(EntityBlueprint $blueprint, $field)
    {
        $blueprint->addField($field);
    }

    public function makeProtoEntity(EntityBlueprint $blueprint, RepositoryInterface $repo)
    {
        return $this->protoFactory->convert($blueprint, $repo);
    }

    public function makeRealEntity(EntityBlueprint $blueprint, RepositoryInterface $repo)
    {
        return $this->realFactory->convert($blueprint, $repo);
    }

} 