<?php
namespace Plu\RerBundle\Forge\Callback;

use Plu\RerBundle\Entity\CallbackRealEntity;
use Plu\RerBundle\Field\IntegerField;
use Plu\RerBundle\Forge\EntityBlueprint;

class CallbackRealEntityFactoryTest extends \PHPUnit_Framework_TestCase
{

    private $factory;

    private $mockRepository;

    public function setup()
    {
        $this->factory = new CallbackRealEntityFactory();
        $this->mockRepository = $this->getMock('Plu\RerBundle\Repository\RepositoryInterface');
    }

    public function testItConvertsEmptyBluePrintToEmptyProtoEntity()
    {
        $entity = new CallbackRealEntity($this->mockRepository);
        $this->assertEquals($entity, $this->factory->convert(new EntityBlueprint(), $this->mockRepository));
    }

    public function testItConvertsBluePrintWithFieldToProtoEntity()
    {
        $blueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
        $blueprint->expects($this->once())->method('getFields')->will($this->returnValue(array(new IntegerField('name'))));

        $this->assertEquals(1, count($this->factory->convert($blueprint, $this->mockRepository)->getFields()));

    }

    public function testItConvertsBluePrintWithTwoFieldsToProtoEntity()
    {
        $blueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
        $blueprint->expects($this->once())->method('getFields')->will($this->returnValue(array(new IntegerField('name'), new IntegerField('other_name'))));

        $this->assertEquals(2, count($this->factory->convert($blueprint, $this->mockRepository)->getFields()));

    }

}
 