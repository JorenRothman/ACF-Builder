<?php

use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleContent;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleLayout;
use PHPUnit\Framework\TestCase;


final class FlexibleContentTest extends TestCase
{
    public function testBuild()
    {
        $flexibleContent = new FlexibleContent('Flexible Content');

        $flexibleLayout = new FlexibleLayout('Flexible Layout');

        $flexibleContent->addLayout($flexibleLayout);

        $result = $flexibleContent->build();

        $expected = [
            'key' => 'field_flexible_content',
            'label' => 'Flexible Content',
            'name' => 'flexible_content',
            'type' => 'flexible_content',
            'instructions' => '',
            'required' => false,
            'conditional_logic' => false,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'layouts' => array(
                'layout_flexible_layout' => array(
                    'key' => 'layout_flexible_layout',
                    'name' => 'flexible_layout',
                    'label' => 'Flexible Layout',
                    'display' => 'block',
                    'sub_fields' => array(),
                    'min' => 0,
                    'max' => 0,
                ),
            ),
            'button_label' => 'Add Row',
            'min' => 0,
            'max' => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testBuildLayoutWithSubFields()
    {
        $flexibleContent = new FlexibleContent('Content');
        $layout = new FlexibleLayout('Hero');
        $layout->addSubField(new Text('Heading'));
        $flexibleContent->addLayout($layout);

        $result = $flexibleContent->build();

        $subField = $result['layouts']['layout_hero']['sub_fields'][0];
        $this->assertEquals('field_layout_hero_field_heading', $subField['key']);
        $this->assertEquals('heading', $subField['name']);
    }

    public function testBuildIsIdempotent()
    {
        $flexibleContent = new FlexibleContent('Content');
        $layout = new FlexibleLayout('Hero');
        $layout->addSubField(new Text('Heading'));
        $flexibleContent->addLayout($layout);

        $first  = $flexibleContent->build();
        $second = $flexibleContent->build();

        $this->assertEquals($first, $second);
        $this->assertEquals('field_content', $flexibleContent->key);
    }
}
