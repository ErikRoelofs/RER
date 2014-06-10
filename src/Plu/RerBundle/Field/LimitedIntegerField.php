<?php

namespace Plu\RerBundle\Field;

use Plu\RerBundle\Matcher\Integer\IntegerMatcher;

class LimitedIntegerField extends IntegerField
{

    private $name;
    private $matcher;

    public function __construct($name, IntegerMatcher $matcher)
    {
        parent::__construct($name);
        $this->matcher = $matcher;
    }

    public function getMatcher()
    {
        return $this->matcher;
    }

    public function isValid($value)
    {
        return parent::isValid($value) && $this->matcher->matches($value);
    }


} 