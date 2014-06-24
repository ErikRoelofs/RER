<?php

namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Field\IntegerField;

class EntityForgeTest extends \PHPUnit_Framework_TestCase
{

    private $forge;
    private $mockBlueprint;
    private $mockFactory;
    private $mockFactory2;

    public function setUp()
    {
        $this->mockFactory = $this->getMock('Plu\RerBundle\Forge\ProtoEntityFactory');
        $this->mockFactory2 = $this->getMock('Plu\RerBundle\Forge\RealEntityFactory');
        $this->forge = new EntityForge($this->mockFactory, $this->mockFactory2);
        $this->mockBlueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
        $this->mockRepository = $this->getMock('Plu\RerBundle\Repository\RepositoryInterface');
    }

    public function testItShouldAllowCreatingABlueprint()
    {
        $this->assertEquals($this->forge->newBlueprint(), new EntityBlueprint());
    }

    public function testItShouldAllowAddingAFieldToABlueprint()
    {
        $field = new IntegerField('name');
        $this->mockBlueprint->expects($this->once())->method('addField')->with($field);
        $this->forge->addField($this->mockBlueprint, $field);
    }


    public function testItShouldAllowCreatingProtoEntities()
    {
        $this->mockFactory->expects($this->once())->method('convert')->with($this->mockBlueprint, $this->mockRepository)->will($this->returnValue('test'));
        $this->assertEquals('test', $this->forge->makeProtoEntity($this->mockBlueprint, $this->mockRepository));
    }

    public function testItShouldAllowCreatingRealEntities()
    {
        $this->mockFactory2->expects($this->once())->method('convert')->with($this->mockBlueprint, $this->mockRepository)->will($this->returnValue('test'));
        $this->assertEquals('test', $this->forge->makeRealEntity($this->mockBlueprint, $this->mockRepository));
    }


}
 