<?php

use Joren\ACFBuilder\Fields\Basic\Text;
use Joren\ACFBuilder\Fields\Layout\FlexibleContent;
use Joren\ACFBuilder\Fields\Layout\FlexibleLayout;
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
                    'min' => '',
                    'max' => '',
                ),
            ),
            'button_label' => 'Add Row',
            'min' => '',
            'max' => '',
        ];

        $this->assertEquals($expected, $result);
    }
}
