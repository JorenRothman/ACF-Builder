<?php

use Joren\ACFBuilder\Fields\Basic\Text;
use Joren\ACFBuilder\Fields\Layout\FlexibleLayout;
use PHPUnit\Framework\TestCase;


final class FlexibleLayoutTest extends TestCase
{
    public function testBuild()
    {
        $flexibleLayout = new FlexibleLayout('Flexible Layout');

        $flexibleLayout->addSubField(new Text('Text Field'));

        $result = $flexibleLayout->build();

        $expected = [
            'key' => 'layout_flexible_layout',
            'name' => 'flexible_layout',
            'label' => 'Flexible Layout',
            'display' => 'block',
            'sub_fields' => [
                [
                    'key' => 'field_layout_flexible_layout_field_text_field',
                    'label' => 'Text Field',
                    'name' => 'text_field',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => false,
                    'conditional_logic' => false,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ],
            ],
            'min' => '',
            'max' => '',
        ];

        $this->assertEquals($expected, $result);
    }
}
