<?php

class Rule implements RestrictorInterface, MeasureInterface
{

    private $restrictor;
    private $measure;

    public function __construct($restrictor, $measure)
    {
        $this->restrictor = $restrictor;
        $this->measure = $measure;
    }

    public function calculate($item)
    {
        return $this->measure->calculate($item);
    }

    public function relevant($item)
    {
        return $this->restrictor->relevant($item);
    }


} 