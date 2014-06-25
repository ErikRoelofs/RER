<?php

namespace Plu\RerBundle\Matcher\Entity;

use Plu\RerBundle\Entity\RealEntity;
use Plu\RerBundle\Matcher\Matcher;

class ExactEntityMatcher implements Matcher
{

    private $matchAgainst;

    public function setValue(RealEntity $entity)
    {
        $this->matchAgainst = $entity;
    }


    public function matches($value)
    {
        return $this->matchAgainst->type() == $value->type() && $this->matchAgainst->uniq() == $value->uniq();
    }

} 