<?php

namespace Plu\RerBundle\Tests\Matcher\Integer;


use Plu\RerBundle\Matcher\Integer\ExactIntegerMatcher;

class IntegerMatcherTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->matcher = new ExactIntegerMatcher();
    }

    public function testIntegerMatchesSameNumber()
    {
        $this->matcher->setValue(5);
        $this->assertTrue($this->matcher->matches(5));
    }

    public function testIntegerNotMatchesDifferentNumber()
    {
        $this->matcher->setValue(4);
        $this->assertFalse($this->matcher->matches(5));
    }

    public function testIntegerNotMatchesFloat()
    {
        $this->matcher->setValue(5);
        $this->assertFalse($this->matcher->matches(5.0));
    }

    public function testIntegerNotAcceptsNonIntegers()
    {
        try {
            $this->matcher->setValue(5.0);
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

}
 