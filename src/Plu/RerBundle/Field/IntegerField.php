<?php

namespace Plu\RerBundle\Field;

class IntegerField implements Field
{

    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

} 