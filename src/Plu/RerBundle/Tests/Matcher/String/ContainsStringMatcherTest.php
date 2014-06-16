<?php

namespace Plu\RerBundle\Matcher\String;

class ContainsStringMatcherTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->matcher = new ContainsStringMatcher();
    }

    public function testStringMatchesContainedInSameString()
    {
        $this->matcher->setValue('test');
        $this->assertTrue($this->matcher->matches('test'));
    }

    public function testStringMatchesContainedString()
    {
        $this->matcher->setValue('test');
        $this->assertTrue($this->matcher->matches('derp testderp'));
    }

    public function testStringMatchesContainedStringAtStart()
    {
        $this->matcher->setValue('test');
        $this->assertTrue($this->matcher->matches('testderp'));
    }

    public function testStringMatchesContainedStringAtEnd()
    {
        $this->matcher->setValue('test');
        $this->assertTrue($this->matcher->matches('derptest'));
    }

    public function testStringNotMatchesNotContainsString()
    {
        $this->matcher->setValue('test');
        $this->assertFalse($this->matcher->matches('derpmcherp'));
    }

    public function testStringNotAcceptsNonStrings()
    {
        try {
            $this->matcher->setValue(1);
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

}
 