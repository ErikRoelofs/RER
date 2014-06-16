<?php

namespace Plu\RerBundle\Matcher\String;

class OrStringMatcher implements StringMatcher
{

    private $matchers = array();

    public function addMatcher(StringMatcher $matcher)
    {
        $this->matchers[] = $matcher;
    }

    public function matches($value)
    {
        foreach ($this->matchers as $matcher) {
            if ($matcher->matches($value)) {
                return true;
            }
        }
        return false;
    }

} 