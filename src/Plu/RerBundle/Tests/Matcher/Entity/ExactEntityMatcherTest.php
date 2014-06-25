<?php

namespace Plu\RerBundle\Matcher\Entity;

use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Entity\RealEntity;

class ExactEntityMatcherTest extends \PHPUnit_Framework_TestCase
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
        $this->value = new RealEntity();
        $this->value->type('test');
        $this->value->uniq(123);
        $this->matcher = new ExactEntityMatcher();
        $this->matcher->setValue($this->value);

    }

    public function testItCanMatchExactEntities()
    {
        $this->assertTrue($this->matcher->matches($this->value));
    }

    public function testItCanMatchExactEntitiesThatAreNotTheSameObject()
    {
        $value = new RealEntity();
        $value->type('test');
        $value->uniq(123);
        $this->assertTrue($this->matcher->matches($value));
    }

    public function testItCanFailMatchExactEntities()
    {
        $value = new RealEntity();
        $value->type('test');
        $value->uniq(124);

        $this->assertFalse($this->matcher->matches($value));

    }

}
 