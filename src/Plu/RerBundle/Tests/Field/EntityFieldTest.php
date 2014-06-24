<?php

namespace Plu\RerBundle\Field;

use Plu\RerBundle\Entity\EntityIdentifier;
use Plu\RerBundle\Entity\RealEntity;

class EntityFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanBeCreated()
    {
        $field = new EntityField('name', 'test');
        $this->assertEquals('name', $field->getName());
    }

    public function testItValidatedValues()
    {

        $field = new EntityField('name', 'test');
        $repo = $this->getMock('Plu\RerBundle\Repository\RepositoryInterface');
        $entity = new RealEntity();
        $entity->type('test');
        $entity->uniq(1);
        $repo->expects($this->any())->method('byUniq')->with(1)->will($this->returnValue($entity));
        $rightEntity = new EntityIdentifier($entity, $repo);

        $repo2 = $this->getMock('Plu\RerBundle\Repository\RepositoryInterface');
        $entity2 = new RealEntity();
        $entity2->type('derp');
        $entity2->uniq(2);
        $repo2->expects($this->any())->method('byUniq')->with(2)->will($this->returnValue($entity2));
        $wrongEntity = new EntityIdentifier($entity2, $repo2);

        $this->assertTrue($field->isValid($rightEntity));

        $this->assertFalse($field->isValid($wrongEntity));
        $this->assertFalse($field->isValid(0));
        $this->assertFalse($field->isValid(null));
        $this->assertFalse($field->isValid('test'));
        $this->assertFalse($field->isValid(0.1));
        $this->assertFalse($field->isValid(new \stdClass(3)));
        $this->assertFalse($field->isValid(array()));
    }
}
 