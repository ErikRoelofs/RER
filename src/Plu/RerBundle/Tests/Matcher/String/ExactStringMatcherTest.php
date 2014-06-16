<?php

namespace Plu\RerBundle\Tests\Matcher\Integer;

use Plu\RerBundle\Matcher\String\ExactStringMatcher;

class ExactStringMatcherTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->matcher = new ExactStringMatcher();
    }

    public function testStringMatchesSameString()
    {
        $this->matcher->setValue('test');
        $this->assertTrue($this->matcher->matches('test'));
    }

    public function testIntegerNotMatchesDifferentNumber()
    {
        $this->matcher->setValue('temp');
        $this->assertFalse($this->matcher->matches('test'));
    }

    public function testIntegerNotAcceptsNonStrings()
    {
        try {
            $this->matcher->setValue(1);
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

}
 