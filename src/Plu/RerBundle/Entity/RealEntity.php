<?php

namespace Plu\RerBundle\Entity;

use Plu\RerBundle\Field\Field;

class RealEntity
{

    private $fields = array();

    private $nameLookup = array();

    private $values = array();

    private $uniq = null;

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
        if (is_callable($this->values[$method])) {
            return $this->values[$method]();
        }
        return $this->values[$method];
    }

    public function findValueForField($field)
    {
        if ($field instanceof Field) {
            return $this->findValueForField($field->getName());
        }
        $field = strtolower($field);
        if (isset($this->values[$field])) {
            return $this->values[$field];
        }
    }

    public function uniq($uniq = null)
    {
        if ($uniq) {
            $this->uniq = $uniq;
        }
        return $this->uniq;
    }

    public function type($type = null)
    {
        if ($type) {
            $this->type = $type;
        }
        return $this->type;
    }


}