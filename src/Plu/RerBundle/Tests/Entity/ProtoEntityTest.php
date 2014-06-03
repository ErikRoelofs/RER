<?php

namespace Plu\RerBundle\Entity;

use Plu\RerBundle\Field\Field;
use Plu\RerBundle\Matcher\Integer\IntegerMatcher;

class ProtoEntityTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ProtoEntity;
     */
    private $entity;

    /**
     * @var Field
     */
    private $mockField;

    /**
     * @var IntegerMatcher
     */
    private $mockMatcher;

    public function setUp()
    {
        $this->entity = new ProtoEntity();
        $this->mockField = $this->getMock('Plu\RerBundle\Field\Field');
        $this->mockMatcher = $this->getMock('Plu\RerBundle\Matcher\Integer\IntegerMatcher');
    }

    public function testItMakesSetters()
    {
        $this->mockField->expects($this->any())->method('getName')->will($this->returnValue('int'));
        $this->entity->addField($this->mockField);

        $this->entity->setInt($this->mockMatcher);
    }

    public function testItMakesGetters()
    {
        $this->mockField->expects($this->any())->method('getName')->will($this->returnValue('int'));
        $this->entity->addField($this->mockField);

        $this->entity->setInt($this->mockMatcher);

        $this->assertEquals($this->mockMatcher, $this->entity->getInt());

    }

}
 