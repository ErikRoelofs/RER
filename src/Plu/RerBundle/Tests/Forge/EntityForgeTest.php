<?php

namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Field\IntegerField;

class EntityForgeTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->forge = new EntityForge();
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
 