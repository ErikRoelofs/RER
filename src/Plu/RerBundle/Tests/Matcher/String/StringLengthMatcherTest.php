<?php

namespace Plu\RerBundle\Tests\Matcher\Integer;

use Plu\RerBundle\Matcher\Integer\ExactIntegerMatcher;
use Plu\RerBundle\Matcher\Integer\RangeIntegerMatcher;
use Plu\RerBundle\Matcher\String\StringLengthMatcher;

class StringLengthMatcherTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->matcher = new StringLengthMatcher();
    }

    public function testStringMatchesSameLengthString()
    {
        $matcher = new ExactIntegerMatcher();
        $matcher->setValue(4);
        $this->matcher->setValue($matcher);
        $this->assertTrue($this->matcher->matches('test'));
    }

    public function testStringNotMatchesDifferentLengthString()
    {
        $matcher = new ExactIntegerMatcher();
        $matcher->setValue(3);
        $this->matcher->setValue($matcher);
        $this->assertFalse($this->matcher->matches('test'));

    }

    public function testStringMatchesLengthWithinRange()
    {
        $matcher = new RangeIntegerMatcher();
        $matcher->setRange(2, 4);
        $this->matcher->setValue($matcher);
        $this->assertFalse($this->matcher->matches('a'));
        $this->assertTrue($this->matcher->matches('ab'));
        $this->assertTrue($this->matcher->matches('abc'));
        $this->assertTrue($this->matcher->matches('abcd'));
        $this->assertFalse($this->matcher->matches('abcde'));
        $this->assertFalse($this->matcher->matches('abcdef'));
    }

}
 