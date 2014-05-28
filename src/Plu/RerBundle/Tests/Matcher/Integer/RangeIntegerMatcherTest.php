<?php

namespace Plu\RerBundle\Matcher\Integer;

class RangeIntegerMatcherTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->matcher = new RangeIntegerMatcher();
    }

    public function testIntegerMatchesInBetweenNumber()
    {
        $this->matcher->setRange(1, 10);
        $this->assertTrue($this->matcher->matches(5));
    }

    public function testIntegerMatchesUpperBound()
    {
        $this->matcher->setRange(1, 10);
        $this->assertTrue($this->matcher->matches(10));
    }

    public function testIntegerMatchesLowerBound()
    {
        $this->matcher->setRange(1, 10);
        $this->assertTrue($this->matcher->matches(1));
    }

    public function testIntegerNotMatchesHigherNumber()
    {
        $this->matcher->setRange(1, 10);
        $this->assertFalse($this->matcher->matches(11));
    }

    public function testIntegerNotMatchesLowerNumber()
    {
        $this->matcher->setRange(1, 10);
        $this->assertFalse($this->matcher->matches(0));
    }


    public function testIntegerRefusesEmptyRange()
    {
        try {
            $this->matcher->setRange(3, 2);
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testIntegerAcceptsSingleItemRange()
    {
        $this->matcher->setRange(1, 1);
        $this->assertTrue($this->matcher->matches(1));
    }


}
 