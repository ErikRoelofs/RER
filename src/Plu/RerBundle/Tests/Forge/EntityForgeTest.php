<?php

namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Field\IntegerField;

class EntityForgeTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->mockFactory = $this->getMock('Plu\RerBundle\Forge\ProtoEntityFactory');
        $this->forge = new EntityForge($this->mockFactory);
        $this->mockBlueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
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

}
 