<?php

namespace Plu\RerBundle\Matcher\Entity;

use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Entity\RealEntity;

class ProtoEntityMatcherTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ProtoEntityMatcher
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
        $this->matcher = new ProtoEntityMatcher();
        $this->compareValue = new RealEntity();
    }

    public function testItCanMatchProtoEntities()
    {
        $this->proto->expects($this->once())->method('matches')->with($this->compareValue)->will($this->returnValue(true));
        $this->matcher->setValue($this->proto);

        $this->assertTrue($this->matcher->matches($this->compareValue));

    }

    public function testItCanFailMatchProtoEntities()
    {
        $this->proto->expects($this->once())->method('matches')->with($this->compareValue)->will($this->returnValue(false));
        $this->matcher->setValue($this->proto);

        $this->assertFalse($this->matcher->matches($this->compareValue));

    }

}
 