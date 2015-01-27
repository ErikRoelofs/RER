<?php

namespace Plu\RerBundle\Matcher\Date;

use Plu\RerBundle\Matcher\Matcher;

class BeforeMatcher implements Matcher
{

    private $value;

    public function setValue(\DateTime $value)
    {
        $this->value = $value;
    }

    public function matches($value)
    {
        return $value < $this->value;
    }


} 