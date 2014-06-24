<?php

namespace Plu\RerBundle\Field;

class EntityField implements Field
{

    private $name;

    private $type;

    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isValid($value)
    {
        return is_object($value) && is_callable(array($value, 'type')) && $value->type() == $this->type;
    }

}