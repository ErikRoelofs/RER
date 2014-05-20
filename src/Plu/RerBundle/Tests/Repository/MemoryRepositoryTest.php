<?php

namespace Plu\RerBundle\Repository\Tests;

use Plu\RerBundle\Entity\Entity;
use Plu\RerBundle\Repository\MemoryRepository;

class MemoryRepositoryTest extends \PHPUnit_Framework_TestCase
{

    private $repository;

    private $entity;

    public function setUp()
    {
        $this->repository = new MemoryRepository();
        $this->entity = new Entity();
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

}
 