<?php

use JorenRothman\ACFBuilder\FieldConditionalLogic;
use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Choice\TrueFalse;
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

    public function testConditionalLogicReferencesPrefixedSiblingKey()
    {
        $toggle = new TrueFalse('Toggle');
        $text = (new Text('Text'))
            ->setConditionalLogic((new FieldConditionalLogic)->and($toggle, '==', true));

        $group = new Group('Group');
        $group->addSubField($toggle, $text);

        $result = $group->build();

        $this->assertEquals('field_field_group_field_toggle', $result['sub_fields'][0]['key']);
        $this->assertEquals(
            [[['field' => 'field_field_group_field_toggle', 'operator' => '==', 'value' => '1']]],
            $result['sub_fields'][1]['conditional_logic']
        );
    }

    public function testNestedConditionalLogicReferencesPrefixedSiblingKey()
    {
        $toggle = new TrueFalse('Toggle');
        $text = (new Text('Text'))
            ->setConditionalLogic((new FieldConditionalLogic)->and($toggle, '==', true));

        $group = new Group('Group');
        $group->addSubField($toggle, $text);

        $repeater = new Repeater('Repeater');
        $repeater->addSubField($group);

        $built = $repeater->build()['sub_fields'][0]['sub_fields'];

        $this->assertEquals($built[0]['key'], $built[1]['conditional_logic'][0][0]['field']);
    }
}
