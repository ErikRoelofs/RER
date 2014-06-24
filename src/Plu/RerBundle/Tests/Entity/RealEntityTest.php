<?php

namespace Plu\RerBundle\Entity;

use Plu\RerBundle\Field\Field;
use Plu\RerBundle\Matcher\Integer\IntegerMatcher;

class RealEntityTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var RealEntity;
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
        $this->entity = new RealEntity();
        $this->mockField = $this->getMock('Plu\RerBundle\Field\Field');
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

        $this->entity->setInt(5);

        $this->assertEquals(5, $this->entity->getInt());
    }

    public function canSetUniq()
    {
        $this->entity->uniq(123);
        $this->assertEquals(123, $this->entity->uniq());
    }

    public function canSetType()
    {
        $this->entity->type('name');
        $this->assertEquals('name', $this->entity->type());
    }

}
 