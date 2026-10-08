<?php

use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleLayout;
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
                    'key' => 'field_flexible_layout_text_field',
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
                    'readonly' => false,
                    'disabled' => false,
                ],
            ],
            'min' => 0,
            'max' => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testBuildIsIdempotent()
    {
        $layout = new FlexibleLayout('Flexible Layout');
        $layout->addSubField(new Text('Text Field'));

        $first  = $layout->build();
        $second = $layout->build();

        $this->assertEquals($first, $second);
        $this->assertEquals('layout_flexible_layout', $layout->key);
    }

    public function testMake()
    {
        $layout = FlexibleLayout::make('Hero Layout');

        $this->assertInstanceOf(FlexibleLayout::class, $layout);
        $this->assertEquals('layout_hero_layout', $layout->key);
        $this->assertEquals('hero_layout', $layout->name);
    }
}
