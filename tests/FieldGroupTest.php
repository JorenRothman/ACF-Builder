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

        $this->assertNotEmpty($fieldGroup->key);
    }

    public function testBuild()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test');

        $this->assertIsArray($fieldGroup->build());

        $this->assertEquals([
            'title' => 'My Field Group - Test',
            'name' => 'my_field_group_test',
            'key' => '40c17d408c7dff2f69957d263562188e',
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'show_in_rest' => false,
        ], $fieldGroup->build());
    }

    public function testLocation()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test');

        $fieldGroupLocations = new FieldGroupLocations;

        $fieldGroupLocations->or('post_type', '==', 'page');
        $fieldGroupLocations->and('post_status', '!=', 'trash');
        $fieldGroupLocations->or('post_type', '==', 'post');

        $fieldGroup->setLocations($fieldGroupLocations);

        $expected = [
            'title' => 'My Field Group - Test',
            'name' => 'my_field_group_test',
            'key' => '40c17d408c7dff2f69957d263562188e',
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'show_in_rest' => false,
            'location' => [
                [
                    ['post_type', '==', 'page'],
                    ['post_status', '!=', 'trash'],
                ],
                [
                    ['post_type', '==', 'post'],
                ]
            ]
        ];

        $this->assertEquals($expected, $fieldGroup->build());
    }
}