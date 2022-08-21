<?php

use Joren\ACFBuilder\FieldConditionalLogic;
use Joren\ACFBuilder\FieldGroup;
use Joren\ACFBuilder\FieldGroupLocations;
use Joren\ACFBuilder\Fields\Basic\Text;
use Joren\ACFBuilder\Fields\Choice\TrueFalse;
use Joren\ACFBuilder\Fields\Layout\FlexibleContent;
use Joren\ACFBuilder\Fields\Layout\FlexibleLayout;
use Joren\ACFBuilder\Fields\Layout\Repeater;
use PHPUnit\Framework\TestCase;

class FieldGroupBuildTest extends TestCase
{
    public function testRepeaterBuild()
    {
        $fieldGroup = new FieldGroup('field group');

        $repeater = new Repeater('items');

        $title = new Text('title');

        $repeater->addSubField($title);

        $fieldGroup->addField($repeater);

        $location = new FieldGroupLocations;
        $location->and('post_type', '==', 'post');

        $fieldGroup->setLocations($location);

        $result = $fieldGroup->build();

        $expected = array(
            'key' => 'group_field_group',
            'name' => 'field_group',
            'title' => 'field group',
            'fields' => array(
                array(
                    'key' => 'field_field_group_field_items',
                    'label' => 'Items',
                    'name' => 'field_group_items',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'block',
                    'button_label' => 'Add Row',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_field_field_group_field_items_field_title',
                            'label' => 'Title',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
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
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        );

        $this->assertEquals($expected, $result);
    }

    public function testFlexibleContent()
    {
        $fieldGroup = new FieldGroup('field group');

        $flexibleContent = new FlexibleContent('dynamic content');

        $flexibleLayout = new FlexibleLayout('Layout');

        $title = new Text('title');

        $flexibleLayout->addSubField($title);

        $flexibleContent->addLayout($flexibleLayout);

        $fieldGroup->addField($flexibleContent);

        $location = new FieldGroupLocations;
        $location->and('post_type', '==', 'post');

        $fieldGroup->setLocations($location);

        $result = $fieldGroup->build();

        $expected = array(
            'key' => 'group_field_group',
            'title' => 'field group',
            'name' => 'field_group',
            'fields' => array(
                array(
                    'key' => 'field_field_group_field_dynamic_content',
                    'label' => 'Dynamic Content',
                    'name' => 'field_group_dynamic_content',
                    'type' => 'flexible_content',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layouts' => array(
                        'layout_layout' => array(
                            'key' => 'layout_layout',
                            'name' => 'layout',
                            'label' => 'Layout',
                            'display' => 'block',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_layout_layout_field_title',
                                    'label' => 'Title',
                                    'name' => 'title',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
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
                            'min' => '',
                            'max' => '',
                        ),
                    ),
                    'button_label' => 'Add Row',
                    'min' => '',
                    'max' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        );

        $this->assertEquals($expected, $result);
    }
}
