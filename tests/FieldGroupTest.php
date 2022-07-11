<?php

use Joren\ACFBuilder\FieldGroup;
use Joren\ACFBuilder\FieldGroupLocations;
use PHPUnit\Framework\TestCase;


final class FieldGroupTest extends TestCase
{
    public function testTitle()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test');

        $this->assertEquals('My Field Group - Test', $fieldGroup->title);
        $this->assertEquals('my_field_group_test', $fieldGroup->name);

        $this->assertNotEmpty($fieldGroup->key);
    }

    public function testName()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test', 'my custom name field');

        $this->assertEquals('My Field Group - Test', $fieldGroup->title);
        $this->assertEquals('my_custom_name_field', $fieldGroup->name);

        $this->assertNotEmpty($fieldGroup->key);
    }

    public function testKey()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test', 'my custom name field', 'randodkfhashgohrijaipaf');

        $this->assertEquals('My Field Group - Test', $fieldGroup->title);
        $this->assertEquals('my_custom_name_field', $fieldGroup->name);
        $this->assertEquals('group_randodkfhashgohrijaipaf', $fieldGroup->key);
    }

    public function testBuild()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test');

        $this->assertIsArray($fieldGroup->build());

        $this->assertEquals([
            'title' => 'My Field Group - Test',
            'name' => 'my_field_group_test',
            'key' => 'group_my_field_group_test',
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'show_in_rest' => false,
            'description' => '',
            'location' => [],
            'fields' => [],
        ], $fieldGroup->build());
    }
}
