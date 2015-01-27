<?php

namespace Plu\RerBundle\Matcher\Date;


class DayMatcherTest extends \PHPUnit_Framework_TestCase
{

    private $matcher;

    public function setup()
    {
        $this->matcher = new DayMatcher();
        $this->matcher->setValue(new \DateTime('03-05-2010 12:03:01'));
    }

    public function testItMatchesTheSameDay()
    {
        $this->assertTrue($this->matcher->matches(new \DateTime('03-05-2010 09:12:37')));
    }

    public function testItNotMatchesADifferentDay()
    {
        $this->assertFalse($this->matcher->matches(new \DateTime('04-06-2011 09:12:37')));
    }

    public function testItNotMatchesAnEarlierDay()
    {
        $this->assertFalse($this->matcher->matches(new \DateTime('02-05-2010 09:12:37')));
    }
}
 