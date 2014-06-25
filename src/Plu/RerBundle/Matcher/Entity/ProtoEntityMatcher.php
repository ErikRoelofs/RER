<?php

namespace Plu\RerBundle\Matcher\Entity;

use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Matcher\Matcher;

class ProtoEntityMatcher implements Matcher
{

    private $matchAgainst;

    public function setValue(ProtoEntity $entity)
    {
        $this->matchAgainst = $entity;
    }


    public function matches($value)
    {
        return $this->matchAgainst->matches($value);
    }

} 