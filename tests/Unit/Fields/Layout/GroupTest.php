<?php

use Joren\ACFBuilder\Fields\Basic\Text;
use Joren\ACFBuilder\Fields\Layout\FlexibleContent;
use Joren\ACFBuilder\Fields\Layout\FlexibleLayout;
use Joren\ACFBuilder\Fields\Layout\Group;
use Joren\ACFBuilder\Fields\Layout\Repeater;
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
                ),
            ),
        ];

        $this->assertEquals($expected, $result);
    }
}
