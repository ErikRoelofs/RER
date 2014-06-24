<?php

namespace Plu\RerBundle\Forge;

use Plu\RerBundle\Field\IntegerField;

class EntityBlueprintTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->blueprint = new EntityBlueprint();
    }

    public function testItShouldAllowAddingFields()
    {
        $field = new IntegerField('name');
        $this->blueprint->addField($field);
        $this->assertEquals($this->blueprint->getFields(), array($field));
    }

    public function testItShouldNotAllowDuplicateFields()
    {
        $field = new IntegerField('name');
        $this->blueprint->addField($field);
        try {
            $this->blueprint->addField($field);
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testItShouldAllowRemovingFields()
    {
        $field = new IntegerField('name');
        $this->blueprint->addField($field);
        $this->blueprint->removeField($field);
        $this->assertEquals($this->blueprint->getFields(), array());
    }

    public function testItShouldNotAllowRemovingUnknownFields()
    {
        $field = new IntegerField('name');
        try {
            $this->blueprint->removeField($field);
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testItShouldAllowRemovingFieldsByName()
    {
        $field = new IntegerField('name');
        $this->blueprint->addField($field);
        $this->blueprint->removeFieldByName('name');
        $this->assertEquals($this->blueprint->getFields(), array());
    }

    public function testItShouldNotAllowRemovingUnknownFieldsByName()
    {
        try {
            $this->blueprint->removeFieldByName('name');
            $this->assertTrue(false);
        } catch (\InvalidArgumentException $e) {
            $this->assertTrue(true);
        }
    }

    public function testItShouldAllowSettingAnEntityName()
    {
        $this->blueprint->setEntityName('test');
        $this->assertEquals('test', $this->blueprint->getEntityName());
    }

}