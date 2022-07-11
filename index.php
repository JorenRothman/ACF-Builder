<?php

use Joren\ACFBuilder\FieldGroup;
use Joren\ACFBuilder\Fields\Basic\Text;
use Joren\ACFBuilder\Fields\Layout\FlexibleContent;
use Joren\ACFBuilder\Fields\Layout\FlexibleLayout;
use Joren\ACFBuilder\Fields\Layout\Repeater;

require_once __DIR__ . '/vendor/autoload.php';

$fieldGroup = new FieldGroup('my test field group');

$flexContent = new FlexibleContent('Flexible Content');

$flexLayout = new FlexibleLayout('Flexible Layout');

$flexLayout->addSubField(new Text('Text'));

$flexContent->addLayout($flexLayout);

$fieldGroup->addField($flexContent);

print_r($fieldGroup->build());

$flex = array(
    'key' => 'group_62c94dd0a5146',
    'title' => 'Test Field Group',
    'fields' => array(
        array(
            'key' => 'field_62cc5d4ef4723',
            'label' => 'Flex',
            'name' => 'flex',
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
                'layout_62cc5d526f8bd' => array(
                    'key' => 'layout_62cc5d526f8bd',
                    'name' => 'flex_layout',
                    'label' => 'Flex Layout',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_62cc5d5bf4724',
                            'label' => 'Text',
                            'name' => 'text',
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
