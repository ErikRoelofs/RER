<?php

namespace Plu\RerBundle\Field;

class LimitedIntegerFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanStoreAMatcher()
    {
        $mock = $this->getMock('Plu\RerBundle\Matcher\Integer\IntegerMatcher');
        $field = new LimitedIntegerField('name', $mock);
        $this->assertEquals('name', $field->getName());
        $this->assertEquals($mock, $field->getMatcher());
    }

}
 