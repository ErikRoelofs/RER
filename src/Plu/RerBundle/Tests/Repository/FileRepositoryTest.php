<?php

namespace Plu\RerBundle\Repository\Tests;

use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Entity\RealEntity;
use Plu\RerBundle\Exception\CannotRemoveUnknownEntityException;
use Plu\RerBundle\Field\IntegerField;
use Plu\RerBundle\Forge\EntityBlueprint;
use Plu\RerBundle\Forge\EntityForge;
use Plu\RerBundle\Matcher\Integer\ExactIntegerMatcher;
use Plu\RerBundle\Repository\FileRepository;

class FileRepositoryTest extends \PHPUnit_Framework_TestCase
{

    private $repository;

    private $entity;

    /**
     * @var EntityBlueprint
     */
    private $mockBlueprint;

    /**
     * @var EntityForge
     */
    private $mockForge;

    public function setUp()
    {
        if (file_exists('loc')) {
            unlink('loc');
        }
        $this->initRepo();
        $this->entity = new RealEntity();
        $this->entity->addField(new IntegerField('test'));

        $this->entity2 = new RealEntity();
        $this->entity2->addField(new IntegerField('test'));
    }

    private function initRepo()
    {
        $this->mockBlueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
        $this->mockForge = $this->getMockBuilder('Plu\RerBundle\Forge\EntityForge')->disableOriginalConstructor()->getMock();
        $this->repository = new FileRepository($this->mockBlueprint, $this->mockForge, 'loc');
    }

    public function tearDown()
    {
        if (file_exists('loc')) {
            unlink('loc');
        }
    }

    public function testFileRepositoryCanCountEmpty()
    {
        $this->assertEquals(0, $this->repository->count());
    }

    public function testFileRepositoryPersistsEntity()
    {
        $this->repository->persist($this->entity);
        $this->assertEquals(1, $this->repository->count());
    }


    public function testFileRepositoryCannotRemoveUnknownEntity()
    {
        try {
            $this->repository->remove($this->entity);
            $this->assertEquals(true, false);
        } catch (CannotRemoveUnknownEntityException $e) {
            $this->assertEquals(true, true);
        }
    }

    public function testFileRepositoryCanRemoveKnownEntity()
    {
        $this->repository->persist($this->entity);
        $this->repository->remove($this->entity);
        $this->assertEquals(0, $this->repository->count());
    }

    public function testFileRepositoryCanMakeProtoEntity()
    {
        $this->mockForge->expects($this->once())->method('makeProtoEntity')->with($this->mockBlueprint, $this->repository)->will($this->returnValue('test'));
        $this->assertEquals('test', $this->repository->getProtoEntity());
    }

    public function testFileRepositoryCanMakeNewEntityFromBlueprint()
    {
        $this->mockForge->expects($this->once())->method('makeRealEntity')->with($this->mockBlueprint, $this->repository)->will($this->returnValue('test'));
        $this->assertEquals('test', $this->repository->newEntity());
    }

    public function testFileRepositoryCanUpdateEntity()
    {
        // persist it; update it
        $this->repository->persist($this->entity);
        $this->entity->setTest(3);
        $this->repository->update($this->entity);

        // make a search object
        $proto = new ProtoEntity();
        $proto->addField(new IntegerField('test'));
        $matcher = new ExactIntegerMatcher();
        $matcher->setValue(3);
        $proto->setTest($matcher);

        // rebuild it; search it
        $this->initRepo();
        $hits = $this->repository->searchFor($proto);
        $this->assertEquals(1, count($hits));
        $this->assertEquals(3, $hits[0]->getTest());

    }

    public function testFileRepositoryMaintainsConnectionsOnReload()
    {
        // persist it; update it
        $this->repository->persist($this->entity);
        $this->entity->setTest(3);
        $this->repository->update($this->entity);

        // add another
        $this->repository->persist($this->entity2);

        // modifify it again
        $this->entity->setTest(5);
        $this->repository->update($this->entity);

        // make a search object
        $proto = new ProtoEntity();
        $proto->addField(new IntegerField('test'));
        $matcher = new ExactIntegerMatcher();
        $matcher->setValue(5);
        $proto->setTest($matcher);

        // now search it
        $hits = $this->repository->searchFor($proto);
        $this->assertEquals(1, count($hits));
        $this->assertEquals(5, $hits[0]->getTest());

    }

}