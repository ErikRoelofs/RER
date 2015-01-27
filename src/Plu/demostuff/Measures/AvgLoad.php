<?php

class AvgLoad implements MeasureInterface
{

    private $load = 0;
    private $count = 0;

    public function calculate($item)
    {
        $this->count++;
        $this->load += $item[0];
    }

} 