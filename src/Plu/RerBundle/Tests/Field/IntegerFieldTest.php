<?php

namespace Plu\RerBundle\Field;

class IntegerFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanBeCreated()
    {
        $field = new IntegerField('name');
        $this->assertEquals('name', $field->getName());
    }
}
 