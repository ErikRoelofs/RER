<?php

namespace Plu\RerBundle\Matcher\Date;

use Plu\RerBundle\Matcher\Matcher;

class DayMatcher implements Matcher
{

    private $value;

    public function setValue(\DateTime $value)
    {
        $this->value = $value;
    }

    public function matches($value)
    {
        return $value->format('Ymd') == $this->value->format('Ymd');
    }


} 