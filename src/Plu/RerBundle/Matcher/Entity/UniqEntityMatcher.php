<?php

namespace Plu\RerBundle\Matcher\Entity;

use Plu\RerBundle\Entity\ProtoEntity;
use Plu\RerBundle\Matcher\Matcher;

class UniqEntityMatcher implements Matcher
{

    private $uniq;

    public function setValue($uniq)
    {
        $this->uniq = $uniq;
    }


    public function matches($value)
    {
        return $this->uniq == $value->uniq();
    }

} 