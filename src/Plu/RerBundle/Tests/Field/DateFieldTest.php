<?php

namespace Plu\RerBundle\Field;

class DateFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanBeCreated()
    {
        $field = new DateField('name');
        $this->assertEquals('name', $field->getName());
    }

    public function testItValidatedValues()
    {

        $field = new DateField('name');
        $this->assertTrue($field->isValid(new \DateTime));
        $this->assertTrue($field->isValid(new \DateTime('01-01-1970')));
        $this->assertTrue($field->isValid(new \DateTime('31-12-2030')));

        $this->assertFalse($field->isValid(1));
        $this->assertFalse($field->isValid(null));
        $this->assertFalse($field->isValid('0'));
        $this->assertFalse($field->isValid(0.1));
        $this->assertFalse($field->isValid(new \stdClass(3)));
        $this->assertFalse($field->isValid(array()));
    }
}
 