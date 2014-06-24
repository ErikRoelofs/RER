<?php

namespace Plu\RerBundle\Field;

use Plu\RerBundle\Entity\RealEntity;

class EntityFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanBeCreated()
    {
        $field = new EntityField('name', 'test');
        $this->assertEquals('name', $field->getName());
    }

    public function testItValidatedValues()
    {

        $field = new EntityField('name', 'test');
        $rightEntity = new RealEntity();
        $rightEntity->type('test');
        $wrongEntity = new RealEntity();
        $wrongEntity->type('derp');

        $this->assertTrue($field->isValid($rightEntity));

        $this->assertFalse($field->isValid($wrongEntity));
        $this->assertFalse($field->isValid(0));
        $this->assertFalse($field->isValid(null));
        $this->assertFalse($field->isValid('test'));
        $this->assertFalse($field->isValid(0.1));
        $this->assertFalse($field->isValid(new \stdClass(3)));
        $this->assertFalse($field->isValid(array()));
    }
}
 