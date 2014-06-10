<?php

namespace Plu\RerBundle\Field;

interface Field
{

    public function getName();

    public function isValid($value);

} 