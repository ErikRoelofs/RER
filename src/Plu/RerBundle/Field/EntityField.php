<?php

namespace Plu\RerBundle\Field;

use Plu\RerBundle\Entity\EntityIdentifier;

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
        return $value instanceof EntityIdentifier && $value->getEntity() && $value->getEntity()->type() == $this->type;
    }

}