<?php

use JorenRothman\ACFBuilder\FieldConditionalLogic;
use JorenRothman\ACFBuilder\FieldGroup;
use JorenRothman\ACFBuilder\FieldGroupLocations;
use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Choice\TrueFalse;
use JorenRothman\ACFBuilder\Fields\Layout\Repeater;
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

    public function testBuildWithField()
    {
        $group = new FieldGroup('My Group');
        $group->addField(new Text('Title'));

        $result = $group->build();

        $this->assertCount(1, $result['fields']);
        $this->assertEquals('field_my_group_field_title', $result['fields'][0]['key']);
        $this->assertEquals('my_group_title', $result['fields'][0]['name']);
    }

    public function testBuildWithRepeater()
    {
        $group    = new FieldGroup('My Group');
        $repeater = new Repeater('Items');
        $repeater->addSubField(new Text('Label'));
        $group->addField($repeater);

        $result      = $group->build();
        $repeaterOut = $result['fields'][0];

        $this->assertEquals('field_my_group_field_items', $repeaterOut['key']);
        $this->assertEquals('field_field_my_group_field_items_field_label', $repeaterOut['sub_fields'][0]['key']);
    }

    public function testBuildWithConditionalLogic()
    {
        $group   = new FieldGroup('My Group');
        $trigger = new TrueFalse('Show Email');
        $email   = new Text('Email');

        $logic = new FieldConditionalLogic();
        $logic->and($trigger, '==', true);
        $email->setConditionalLogic($logic);

        $group->addField($trigger);
        $group->addField($email);

        $result = $group->build();

        $emailOut = $result['fields'][1];
        $this->assertEquals([
            [['field' => 'field_my_group_field_show_email', 'operator' => '==', 'value' => '1']],
        ], $emailOut['conditional_logic']);
    }

    public function testBuildIsIdempotent()
    {
        $group    = new FieldGroup('My Group');
        $repeater = new Repeater('Items');
        $repeater->addSubField(new Text('Label'));
        $group->addField($repeater);

        $first  = $group->build();
        $second = $group->build();

        $this->assertEquals($first, $second);
    }
}
