<?php

use Joren\ACFBuilder\Fields\Basic\Text;
use Joren\ACFBuilder\Fields\Layout\FlexibleContent;
use Joren\ACFBuilder\Fields\Layout\FlexibleLayout;
use Joren\ACFBuilder\Fields\Layout\Repeater;
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
                    'key' => 'field_field_repeater_field_text',
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
            'default_value' => '',
        ];

        $this->assertEquals($expected, $result);
    }
}
