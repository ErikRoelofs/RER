<?php

namespace Plu\RerBundle\Matcher\Integer;

class RangeIntegerMatcher implements IntegerMatcher
{

    private $low;
    private $high;

    public function setRange($low, $high)
    {
        if (!is_int($low)) {
            throw new \InvalidArgumentException('Low value: ' . (string) $low . ' is not an Integer.');
        }
        if (!is_int($high)) {
            throw new \InvalidArgumentException('High value: ' . (string) $high . ' is not an Integer.');
        }
        if ($low > $high) {
            throw new \InvalidArgumentException('Range not possible; upper bound ' . $high . ' is lower than ' . $low);
        }
        $this->low = $low;
        $this->high = $high;
    }

    public function matches($value)
    {
        if (!is_int($value)) {
            return false;
        }
        return $value >= $this->low && $value <= $this->high;
    }

} 