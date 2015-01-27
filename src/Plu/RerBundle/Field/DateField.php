<?php

namespace Plu\RerBundle\Field;

class DateField implements Field
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

    public function isValid($value)
    {
        return $value instanceof \DateTime;
    }

}