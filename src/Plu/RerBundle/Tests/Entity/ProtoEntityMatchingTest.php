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
        $this->field2 = new IntegerField('value2');
        $this->proto->addField($this->field);
        $this->proto->addField($this->field2);

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

    public function testItSuccessfullyMatchesMultipleFieldsWithAnd()
    {
        $this->matcher = new ExactIntegerMatcher();
        $this->matcher->setValue(5);
        $this->proto->setValue($this->matcher);

        $this->matcher2 = new ExactIntegerMatcher();
        $this->matcher2->setValue(2);
        $this->proto->setValue2($this->matcher2);

        $this->entity = $this->makeEntity(5, 2);

        $this->assertTrue($this->proto->matches($this->entity));

    }

    public function testItFailsToMatchesMultipleFieldsWithOr()
    {
        $this->matcher = new ExactIntegerMatcher();
        $this->matcher->setValue(5);
        $this->proto->setValue($this->matcher);

        $this->matcher2 = new ExactIntegerMatcher();
        $this->matcher2->setValue(1);
        $this->proto->setValue2($this->matcher2);

        $this->entity = $this->makeEntity(5, 2);

        $this->assertFalse($this->proto->matches($this->entity));

    }

    private function makeEntity($value, $value2 = null)
    {
        $e = new RealEntity();
        $e->addField($this->field);
        $e->setValue($value);
        $e->addField($this->field2);
        $e->setValue2($value2);
        return $e;
    }

}
 