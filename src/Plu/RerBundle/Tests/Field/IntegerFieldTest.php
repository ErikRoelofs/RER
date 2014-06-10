<?php

namespace Plu\RerBundle\Field;

class IntegerFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanBeCreated()
    {
        $field = new IntegerField('name');
        $this->assertEquals('name', $field->getName());
    }

    public function testItValidatedValues()
    {

        $field = new IntegerField('name');
        $this->assertTrue($field->isValid(0));
        $this->assertTrue($field->isValid(1));
        $this->assertTrue($field->isValid(3));
        $this->assertTrue($field->isValid(100000));
        $this->assertTrue($field->isValid(0x05124));

        $this->assertFalse($field->isValid(null));
        $this->assertFalse($field->isValid('0'));
        $this->assertFalse($field->isValid(0.1));
        $this->assertFalse($field->isValid(new \stdClass(3)));
        $this->assertFalse($field->isValid(array()));
    }
}
 