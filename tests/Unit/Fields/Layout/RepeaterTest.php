<?php

use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleContent;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleLayout;
use JorenRothman\ACFBuilder\Fields\Layout\Repeater;
use PHPUnit\Framework\TestCase;


final class RepeaterTest extends TestCase
{
    public function testBuild()
    {
        $repeater = new Repeater('Repeater');

        $repeater->addSubField(new Text('Text'));

        $result = $repeater->build();

        $expected = [
            'key' => 'field_repeater',
            'label' => 'Repeater',
            'name' => 'repeater',
            'type' => 'repeater',
            'instructions' => '',
            'required' => false,
            'conditional_logic' => false,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => false,
            'min' => 0,
            'max' => 0,
            'layout' => 'block',
            'button_label' => 'Add Row',
            'sub_fields' => array(
                array(
                    'key' => 'field_repeater_text',
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
        $repeater = new Repeater('Repeater');

        $result = $repeater->build();

        $this->assertEquals([], $result['sub_fields']);
    }

    public function testBuildIsIdempotent()
    {
        $repeater = new Repeater('Repeater');
        $repeater->addSubField(new Text('Text'));

        $first  = $repeater->build();
        $second = $repeater->build();

        $this->assertEquals($first, $second);
        $this->assertEquals('field_repeater', $repeater->key);
    }

    public function testCollapsed()
    {
        $repeater = new Repeater('Repeater');

        $text = new Text('Text');

        $repeater->setCollapsed($text);

        $repeater->addSubField($text);

        $build = $repeater->build();

        $result = $build['collapsed'];

        $this->assertEquals('field_repeater_text', $result);
    }
}
