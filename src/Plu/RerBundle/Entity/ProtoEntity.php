<?php

namespace Plu\RerBundle\Entity;

use Plu\RerBundle\Field\Field;
use Plu\RerBundle\Matcher\Matcher;

class ProtoEntity
{

    private $fields = array();

    private $nameLookup = array();

    private $values = array();

    private $type = '';

    public function addField(Field $field)
    {
        if (isset($this->nameLookup[$field->getName()])) {
            throw new \InvalidArgumentException("A field named '" . $field->getName() . ' already exists.');
        }
        $this->fields[] = $field;
        $this->values[strtolower($field->getName())] = false;
        $this->nameLookup[$field->getName()] = $field;
    }

    public function removeField(Field $field)
    {
        if (!isset($this->nameLookup[$field->getName()]) || $this->nameLookup[$field->getName()] !== $field) {
            throw new \InvalidArgumentException("This field named " . $field->getName() . " is not a part of this blueprint.");
        }
        $this->removeFieldByName($field->getName());
    }

    public function removeFieldByName($field)
    {
        if (!isset($this->nameLookup[$field])) {
            throw new \InvalidArgumentException("A field named " . $field . " could not be found.");
        }
        foreach ($this->fields as $key => $knownField) {
            if ($field === $knownField->getName()) {
                unset($this->fields[$key]);
                break;
            }
        }
        unset($this->nameLookup[$field]);
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function __call($method, $args)
    {
        if (substr($method, 0, 3) == 'set') {
            return $this->handleSet(strtolower(substr($method, 3)), $args);
        } elseif (substr($method, 0, 3) == 'get') {
            return $this->handleGet(strtolower(substr($method, 3)), $args);
        }
        throw new \InvalidArgumentException("No such method: " . $method);
    }

    private function handleSet($method, $args)
    {
        if (!isset($this->values[$method])) {
            throw new \InvalidArgumentException("No such method: " . $method);
        }
        $this->values[$method] = $args[0];
    }

    private function handleGet($method, $args)
    {
        if (!isset($this->values[$method])) {
            throw new \InvalidArgumentException("No such method: " . $method);
        }
        return $this->getValueFor($method);
    }

    private function getValueFor($field)
    {
        if ($field instanceof Field) {
            return $this->getValueFor($field->getName());
        }
        if (isset ($this->values[$field])) {
            return $this->values[$field];
        }
    }

    public function matches(RealEntity $entity)
    {
        foreach ($this->getFields() as $field) {
            $matcher = $this->getValueFor($field);
            if ($matcher instanceof Matcher) {
                if (!$matcher->matches($entity->findValueForField($field))) {
                    return false;
                }
            }
        }
        return true;
    }

    public function type($type = null)
    {
        if ($type) {
            $this->type = $type;
        }
        return $this->type;
    }

}