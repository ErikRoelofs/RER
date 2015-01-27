<?php

namespace Plu\RerBundle\Matcher\Date;


class AfterMatcherTest extends \PHPUnit_Framework_TestCase
{

    private $matcher;

    public function setup()
    {
        $this->matcher = new AfterMatcher();
        $this->matcher->setValue(new \DateTime('03-05-2010 12:03:01'));
    }

    public function testItMatchesLaterTime()
    {
        $this->assertTrue($this->matcher->matches(new \DateTime('03-06-2010 09:12:37')));
    }

    public function testItFailsMatchingEarlierTime()
    {
        $this->assertFalse($this->matcher->matches(new \DateTime('04-06-2009 09:12:37')));
    }
}
 