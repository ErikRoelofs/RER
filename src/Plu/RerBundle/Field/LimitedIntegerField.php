<?php

namespace Plu\RerBundle\Field;

use Plu\RerBundle\Matcher\Integer\IntegerMatcher;

class LimitedIntegerField implements Field
{

    private $name;
    private $matcher;

    public function __construct($name, IntegerMatcher $matcher)
    {
        $this->name = $name;
        $this->matcher = $matcher;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMatcher()
    {
        return $this->matcher;
    }

} 