<?php

namespace Plu\RerBundle\Matcher\Integer;

class ExactIntegerMatcher implements IntegerMatcher
{

    private $value;

    public function setValue($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException((string) $value . ' is not an Integer.');
        }
        $this->value = $value;
    }

    public function matches($value)
    {
        if (!is_int($value)) {
            return false;
        }
        return $this->value == $value;
    }

} 