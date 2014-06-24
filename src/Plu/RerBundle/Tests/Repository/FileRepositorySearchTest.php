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
use Plu\RerBundle\Repository\MemoryRepository;

class FileRepositorySearchTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var FileRepository;
     */
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
        $this->mockBlueprint = $this->getMock('Plu\RerBundle\Forge\EntityBlueprint');
        $this->mockForge = $this->getMockBuilder('Plu\RerBundle\Forge\EntityForge')->disableOriginalConstructor()->getMock();
        $this->repository = new FileRepository($this->mockBlueprint, $this->mockForge, 'loc');
        $this->entity = new RealEntity();
    }

    public function tearDown()
    {
        if (file_exists('loc')) {
            unlink('loc');
        }
    }

    public function testMemoryRepositoryCanSearchForEmptyProto()
    {
        $entities = $this->makeEntities(array(1, 3, 5, 7, 10));
        $proto = $this->makeProtoEntity();

        foreach ($entities as $entity) {
            $this->repository->persist($entity);
        }
        $hits = $this->repository->searchFor($proto);
        $this->assertEquals(5, count($hits));
    }

    public function testMemoryRepositoryCanSearchWithMatcher()
    {
        $entities = $this->makeEntities(array(1, 3, 5, 7, 10));
        $proto = $this->makeProtoEntity();
        $matcher = new ExactIntegerMatcher();
        $matcher->setValue(5);
        $proto->setValue($matcher);

        foreach ($entities as $entity) {
            $this->repository->persist($entity);
        }
        $hits = $this->repository->searchFor($proto);
        $this->assertEquals(1, count($hits));
        $this->assertEquals(5, $hits[0]->getValue());
    }

    private function makeEntities($list)
    {
        $entities = array();
        foreach ($list as $value) {
            $entity = new RealEntity();
            $entity->addField(new IntegerField('value'));
            $entity->setValue($value);
            $entities[] = $entity;
        }
        return $entities;
    }

    private function makeProtoEntity()
    {
        $entity = new ProtoEntity();
        $entity->addField(new IntegerField('value'));
        return $entity;
    }

}