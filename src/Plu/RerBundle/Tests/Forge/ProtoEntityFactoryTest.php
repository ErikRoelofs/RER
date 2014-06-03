<?php
namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Field\IntegerField;

class ProtoEntityFactoryTest extends \PHPUnit_Framework_TestCase
{

    private $factory;

    public function setup()
    {
        $this->factory = new ProtoEntityFactory();
    }

    public function testItConvertsEmptyBluePrintToEmptyProtoEntity()
    {
        $entity = new ProtoEntity();
        $this->assertEquals($entity, $this->factory->convert(new EntityBlueprint()));
    }

    public function testItConvertsBluePrintWithFieldToProtoEntity()
    {
        $blueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
        $blueprint->expects($this->once())->method('getFields')->will($this->returnValue(array(new IntegerField('name'))));

        $this->assertEquals(1, count($this->factory->convert($blueprint)->getFields()));

    }

    public function testItConvertsBluePrintWithTwoFieldsToProtoEntity()
    {
        $blueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
        $blueprint->expects($this->once())->method('getFields')->will($this->returnValue(array(new IntegerField('name'), new IntegerField('other_name'))));

        $this->assertEquals(2, count($this->factory->convert($blueprint)->getFields()));

    }

}
 