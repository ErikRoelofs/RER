<?php

namespace Plu\RerBundle\Entity;

use Plu\RerBundle\Field\Field;
use Plu\RerBundle\Field\IntegerField;
use Plu\RerBundle\Matcher\Integer\ExactIntegerMatcher;
use Plu\RerBundle\Matcher\Integer\IntegerMatcher;

class ProtoEntityMatchingTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ProtoEntity;
     */
    private $proto;

    public function setUp()
    {
        $this->proto = new ProtoEntity();

        $this->field = new IntegerField('value');
        $this->proto->addField($this->field);

    }

    public function testItMatchesTheSameValue()
    {
        $this->matcher = new ExactIntegerMatcher();
        $this->matcher->setValue(5);
        $this->proto->setValue($this->matcher);

        $this->entity = $this->makeEntity(5);

        $this->assertTrue($this->proto->matches($this->entity));
    }


    public function testItFailsMatchingADifferentValue()
    {
        $this->matcher = new ExactIntegerMatcher();
        $this->matcher->setValue(5);
        $this->proto->setValue($this->matcher);

        $this->entity = $this->makeEntity(4);

        $this->assertFalse($this->proto->matches($this->entity));
    }

    private function makeEntity($value)
    {
        $e = new RealEntity();
        $e->addField($this->field);
        $e->setValue($value);
        return $e;
    }

}
 