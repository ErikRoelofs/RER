<?php

namespace Plu\RerBundle\Matcher\Integer;

class AndIntegerMatcher implements IntegerMatcher
{

    private $matchers = array();

    public function addMatcher(IntegerMatcher $matcher)
    {
        $this->matchers[] = $matcher;
    }


    public function matches($int)
    {
        foreach ($this->matchers as $matcher) {
            if (!$matcher->matches($int)) {
                return false;
            }
        }
        return true;
    }

} 