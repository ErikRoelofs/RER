<?php

namespace Plu\RerBundle\Repository;


interface RepositoryInterface
{
    public function count();

    public function persist( $entity );
} 