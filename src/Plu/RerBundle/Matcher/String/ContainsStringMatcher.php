<?php

namespace Plu\RerBundle\Matcher\String;

class ContainsStringMatcher implements StringMatcher
{

    private $value;

    public function setValue($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException((string) $value . ' is not a String.');
        }
        $this->value = $value;
    }

    public function matches($value)
    {
        if (!is_string($value)) {
            return false;
        }
        return strpos($value, $this->value) !== false;
    }

} 