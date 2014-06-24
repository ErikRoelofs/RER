<?php

namespace Plu\RerBundle\Entity;


class EntityIdentifierTest extends \PHPUnit_Framework_TestCase
{

    public function testItCanBeInvoked()
    {
        $entity = new RealEntity();
        $entity->uniq(1);
        $repo = $this->getMock('Plu\RerBundle\Repository\RepositoryInterface');
        $repo->expects($this->once())->method('byUniq')->with(1)->will($this->returnValue($entity));
        $ei = new EntityIdentifier($entity, $repo);

        $this->assertSame($entity, $ei());
    }

}
 