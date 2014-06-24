<?php

namespace Plu\RerBundle\Forge;

// an entity-blueprint serves as the building plans for the creation of an actual entity (the class, not the object!)
use Plu\RerBundle\Field\Field;

class EntityBlueprint
{

    private $fields = array();

    private $nameLookup = array();

    private $entityName = '';

    public function addField(Field $field)
    {
        if (isset($this->nameLookup[$field->getName()])) {
            throw new \InvalidArgumentException("A field named '" . $field->getName() . ' already exists.');
        }
        $this->fields[] = $field;
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

    public function setEntityName($name)
    {
        $this->entityName = $name;
    }

    public function getEntityName()
    {
        return $this->entityName;
    }

}