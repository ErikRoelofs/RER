<?php

namespace Plu\RerBundle\Field;

class LimitedIntegerFieldTest extends \PHPUnit_Framework_TestCase
{

    private $mock;

    private $field;

    public function setup()
    {
        $this->mock = $this->getMock('Plu\RerBundle\Matcher\Integer\IntegerMatcher');
        $this->field = new LimitedIntegerField('name', $this->mock);
    }

    public function testItCanStoreAMatcher()
    {
        $this->assertEquals('name', $this->field->getName());
        $this->assertEquals($this->mock, $this->field->getMatcher());
    }

    public function testItCanValidateMatchingContents()
    {
        $this->mock->expects($this->once())->method('matches')->with(3)->will($this->returnValue(true));
        $this->assertTrue($this->field->isValid(3));
    }

    public function testItCanRejectNonMatchingContents()
    {
        $this->mock->expects($this->once())->method('matches')->with(3)->will($this->returnValue(false));
        $this->assertFalse($this->field->isValid(3));
    }

    public function testItCanRejectNonIntegers()
    {
        $this->assertFalse($this->field->isValid(null));
    }

}
 