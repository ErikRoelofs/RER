<?php

namespace Plu\RerBundle\Matcher\Entity;

use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Entity\RealEntity;

class UniqEntityMatcherTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ExactEntityMatcher
     */
    private $matcher;

    /**
     * @var ProtoEntity
     */
    private $proto;

    private $compareValue;

    public function setup()
    {
        $this->proto = $this->getMock('Plu\RerBundle\Entity\ProtoEntity');
        $this->matcher = new UniqEntityMatcher();
        $this->compareValue = new RealEntity();
        $this->compareValue->uniq(123);
    }

    public function testItCanMatchOnUniq()
    {
        $this->matcher->setValue(123);
        $this->assertTrue($this->matcher->matches($this->compareValue));
    }

    public function testItCanFailMatchOnUniq()
    {
        $this->matcher->setValue(124);
        $this->assertFalse($this->matcher->matches($this->compareValue));
    }

}
 