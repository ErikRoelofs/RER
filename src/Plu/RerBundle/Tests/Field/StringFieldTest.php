<?php

namespace Plu\RerBundle\Field;

class StringFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanBeCreated()
    {
        $field = new StringField('name');
        $this->assertEquals('name', $field->getName());
    }

    public function testItValidatedValues()
    {

        $field = new StringField('name');
        $this->assertTrue($field->isValid(''));
        $this->assertTrue($field->isValid('test'));
        $this->assertTrue($field->isValid('derp
        derp'));
        $this->assertTrue($field->isValid('#$&^%$*#(&^$%*@&#$%^@$%'));

        $this->assertFalse($field->isValid(null));
        $this->assertFalse($field->isValid(false));
        $this->assertFalse($field->isValid(0.1));
        $this->assertFalse($field->isValid(5));
        $this->assertFalse($field->isValid(new \stdClass(3)));
        $this->assertFalse($field->isValid(array()));
    }
}
 