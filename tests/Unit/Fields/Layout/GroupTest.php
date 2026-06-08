<?php

use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleContent;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleLayout;
use JorenRothman\ACFBuilder\Fields\Layout\Group;
use JorenRothman\ACFBuilder\Fields\Layout\Repeater;
use PHPUnit\Framework\TestCase;


final class GroupTest extends TestCase
{
    public function testBuild()
    {
        $group = new Group('Group');

        $group->addSubField(new Text('Text'));

        $result = $group->build();

        $expected = [
            'key' => 'field_group',
            'label' => 'Group',
            'name' => 'group',
            'type' => 'group',
            'instructions' => '',
            'required' => false,
            'conditional_logic' => false,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
                array(
                    'key' => 'field_field_group_field_text',
                    'label' => 'Text',
                    'name' => 'text',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => false,
                    'conditional_logic' => false,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => false,
                    'disabled' => false,
                ),
            ),
        ];

        $this->assertEquals($expected, $result);
    }

    public function testBuildWithNoSubFields()
    {
        $group = new Group('Group');

        $result = $group->build();

        $this->assertEquals([], $result['sub_fields']);
    }

    public function testBuildIsIdempotent()
    {
        $group = new Group('Group');
        $group->addSubField(new Text('Text'));

        $first  = $group->build();
        $second = $group->build();

        $this->assertEquals($first, $second);
        $this->assertEquals('field_group', $group->key);
    }
}
