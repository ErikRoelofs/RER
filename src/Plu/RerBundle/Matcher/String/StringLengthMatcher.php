<?php

namespace Plu\RerBundle\Matcher\String;

use Plu\RerBundle\Matcher\Integer\IntegerMatcher;

class StringLengthMatcher implements StringMatcher
{

    private $value;

    public function setValue(IntegerMatcher $value)
    {
        $this->value = $value;
    }

    public function matches($value)
    {
        if (!is_string($value)) {
            return false;
        }
        return $this->value->matches(strlen($value));
    }

} 