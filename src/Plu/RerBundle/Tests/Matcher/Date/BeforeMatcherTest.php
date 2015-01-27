<?php

namespace Plu\RerBundle\Matcher\Date;


class BeforeMatcherTest extends \PHPUnit_Framework_TestCase
{

    private $matcher;

    public function setup()
    {
        $this->matcher = new BeforeMatcher();
        $this->matcher->setValue(new \DateTime('03-05-2010 12:03:01'));
    }

    public function testItMatchesEarlierTime()
    {
        $this->assertTrue($this->matcher->matches(new \DateTime('02-05-2010 09:12:37')));
    }

    public function testItFailsMatchingLaterTime()
    {
        $this->assertFalse($this->matcher->matches(new \DateTime('04-06-2011 09:12:37')));
    }
}
 