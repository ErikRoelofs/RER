<?php

namespace Plu\RerBundle\Matcher\String;

class AndStringMatcher implements StringMatcher
{

    private $matchers = array();

    public function addMatcher(StringMatcher $matcher)
    {
        $this->matchers[] = $matcher;
    }


    public function matches($value)
    {
        foreach ($this->matchers as $matcher) {
            if (!$matcher->matches($value)) {
                return false;
            }
        }
        return true;
    }

} 