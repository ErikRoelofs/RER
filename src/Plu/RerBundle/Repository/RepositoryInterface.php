<?php

namespace Plu\RerBundle\Repository;


interface RepositoryInterface
{
    public function count();

    public function persist($entity);

    public function remove($entity);

    public function update($entity);
} 