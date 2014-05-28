<?php

namespace Plu\RerBundle\Matcher\Integer;

class AndIntegerMatcherTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->matcher = new AndIntegerMatcher();
        $this->mockTrueMatcher = $this->getMock('Plu\RerBundle\Matcher\Integer\IntegerMatcher');
        $this->mockTrueMatcher->expects($this->any())->method('matches')->will($this->returnValue(true));
        $this->mockFalseMatcher = $this->getMock('Plu\RerBundle\Matcher\Integer\IntegerMatcher');
        $this->mockFalseMatcher->expects($this->any())->method('matches')->will($this->returnValue(false));
    }

    public function testNoMatcherReturnsTrue()
    {
        $this->assertTrue($this->matcher->matches(1));
    }

    public function testTrueMatcherReturnsTrue()
    {
        $this->matcher->addMatcher($this->mockTrueMatcher);
        $this->assertTrue($this->matcher->matches(1));
    }

    public function testFalseMatcherReturnsFalse()
    {
        $this->matcher->addMatcher($this->mockFalseMatcher);
        $this->assertFalse($this->matcher->matches(1));
    }

    public function testTwoTrueMatchersReturnsTrue()
    {
        $this->matcher->addMatcher($this->mockTrueMatcher);
        $this->matcher->addMatcher($this->mockTrueMatcher);
        $this->assertTrue($this->matcher->matches(1));
    }

    public function testTwoFalseMatchersReturnsFalse()
    {
        $this->matcher->addMatcher($this->mockFalseMatcher);
        $this->matcher->addMatcher($this->mockFalseMatcher);
        $this->assertFalse($this->matcher->matches(1));
    }

    public function testTwoDifferentMatchersReturnsFalse()
    {
        $this->matcher->addMatcher($this->mockTrueMatcher);
        $this->matcher->addMatcher($this->mockFalseMatcher);
        $this->assertFalse($this->matcher->matches(1));
    }

}
 