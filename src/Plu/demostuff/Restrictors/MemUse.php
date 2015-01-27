<?php

class MemUse implements RestrictorInterface
{

    private $value = null;

    public function __construct($value)
    {
        $this->mem = $value;
    }

    public function relevant($item)
    {
        return $item[1] > $this->mem;
    }


} 