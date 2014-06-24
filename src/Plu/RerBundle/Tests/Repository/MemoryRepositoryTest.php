<?php

namespace Plu\RerBundle\Repository\Tests;

use Plu\RerBundle\Entity\RealEntity;
use Plu\RerBundle\Exception\CannotRemoveUnknownEntityException;
use Plu\RerBundle\Field\IntegerField;
use Plu\RerBundle\Forge\EntityBlueprint;
use Plu\RerBundle\Forge\EntityForge;
use Plu\RerBundle\Repository\MemoryRepository;

class MemoryRepositoryTest extends \PHPUnit_Framework_TestCase
{

    private $repository;

    /**
     * @var RealEntity
     */
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
        $this->mockBlueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
        $this->mockForge = $this->getMockBuilder('Plu\RerBundle\Forge\EntityForge')->disableOriginalConstructor()->getMock();
        $this->repository = new MemoryRepository($this->mockBlueprint, $this->mockForge);
        $this->entity = new RealEntity();
    }

    public function testMemoryRepositoryCanCountEmpty()
    {
        $this->assertEquals(0, $this->repository->count());
    }

    public function testMemoryRepositoryPersistsEntity()
    {
        $this->repository->persist($this->entity);
        $this->assertEquals(1, $this->repository->count());
    }

    public function testMemoryRepositoryCannotRemoveUnknownEntity()
    {
        try {
            $this->repository->remove($this->entity);
            $this->assertEquals(true, false);
        } catch (CannotRemoveUnknownEntityException $e) {
            $this->assertEquals(true, true);
        }
    }

    public function testMemoryRepositoryCanRemoveKnownEntity()
    {
        $this->repository->persist($this->entity);
        $this->repository->remove($this->entity);
        $this->assertEquals(0, $this->repository->count());
    }

    public function testMemoryRepositoryCanMakeProtoEntity()
    {
        $this->mockForge->expects($this->once())->method('makeProtoEntity')->with($this->mockBlueprint)->will($this->returnValue('test'));
        $this->assertEquals('test', $this->repository->getProtoEntity());
    }

    public function testMemoryRepositoryCanMakeNewEntityFromBlueprint()
    {
        $this->mockForge->expects($this->once())->method('makeRealEntity')->with($this->mockBlueprint)->will($this->returnValue('test'));
        $this->assertEquals('test', $this->repository->newEntity());
    }

}