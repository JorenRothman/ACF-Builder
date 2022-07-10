<?php

require_once __DIR__ . '/vendor/autoload.php';

if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group(array(
        'key' => 'group_62caee065aec8',
        'title' => 'Test Field Group',
        'fields' => array(),
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
        'hide_on_screen' => array(
            0 => 'permalink',
            1 => 'the_content',
            2 => 'excerpt',
            3 => 'discussion',
            4 => 'comments',
            5 => 'revisions',
            6 => 'slug',
            7 => 'author',
            8 => 'format',
            9 => 'page_attributes',
            10 => 'featured_image',
            11 => 'categories',
            12 => 'tags',
            13 => 'send-trackbacks',
        ),
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));

endif;		

// if (function_exists('acf_add_local_field_group')) :

//     acf_add_local_field_group(array(
//         'key' => 'group_62c88335aae70',
//         'title' => 'Test Field Group',
//         'fields' => array(
//             array(
//                 'key' => 'field_62c8834ae8009',
//                 'label' => 'text field',
//                 'name' => 'text_field',
//                 'type' => 'text',
//                 'instructions' => '',
//                 'required' => 0,
//                 'conditional_logic' => 0,
//                 'wrapper' => array(
//                     'width' => '',
//                     'class' => '',
//                     'id' => '',
//                 ),
//                 'default_value' => '',
//                 'placeholder' => '',
//                 'prepend' => '',
//                 'append' => '',
//                 'maxlength' => '',
//             ),
//         ),
//         'location' => array(
//             array(
//                 array(
//                     'param' => 'post_type',
//                     'operator' => '==',
//                     'value' => 'post',
//                 ),
//                 array(
//                     'param' => 'post_type',
//                     'operator' => '==',
//                     'value' => 'page',
//                 ),
//             ),
//             array(
//                 array(
//                     'param' => 'page_template',
//                     'operator' => '==',
//                     'value' => 'default',
//                 ),
//             ),
//         ),
//         'menu_order' => 0,
//         'position' => 'normal',
//         'style' => 'default',
//         'label_placement' => 'top',
//         'instruction_placement' => 'label',
//         'hide_on_screen' => '',
//         'active' => true,
//         'description' => '',
//         'show_in_rest' => 0,
//     ));

// endif;
