<?php

use Joren\ACFBuilder\Fields\Choice\Checkbox;
use Joren\ACFBuilder\Fields\Choice\Select;
use PHPUnit\Framework\TestCase;

class CheckboxTest extends TestCase
{
    public function testConstructorLabel()
    {
        $checkbox = new Checkbox('checkbox');

        $checkbox->setChoices([
            'red' => 'Red',
            'green' => 'Green',
            'blue' => 'Blue',
        ]);

        $result = $checkbox->build();

        $expected = [
            'key' => 'field_checkbox',
            'label' => 'Checkbox',
            'name' => 'checkbox',
            'type' => 'checkbox',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'red' => 'Red',
                'blue' => 'Blue',
                'green' => 'Green',
            ),
            'allow_custom' => 0,
            'default_value' => array(),
            'layout' => 'vertical',
            'toggle' => 0,
            'return_format' => 'value',
            'save_custom' => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testConstructorLabelName()
    {
        $checkbox = new Checkbox('checkbox', 'checkbox_thing');

        $checkbox->setChoices([
            'red' => 'Red',
            'green' => 'Green',
            'blue' => 'Blue',
        ]);

        $result = $checkbox->build();

        $expected = [
            'key' => 'field_checkbox_thing',
            'label' => 'Checkbox',
            'name' => 'checkbox_thing',
            'type' => 'checkbox',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'red' => 'Red',
                'blue' => 'Blue',
                'green' => 'Green',
            ),
            'allow_custom' => 0,
            'default_value' => array(),
            'layout' => 'vertical',
            'toggle' => 0,
            'return_format' => 'value',
            'save_custom' => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testConstructorLabelNameKey()
    {
        $checkbox = new Checkbox('checkbox', 'checkbox_thing', 'a random key');

        $checkbox->setChoices([
            'red' => 'Red',
            'green' => 'Green',
            'blue' => 'Blue',
        ]);

        $result = $checkbox->build();

        $expected = [
            'key' => 'field_a_random_key',
            'label' => 'Checkbox',
            'name' => 'checkbox_thing',
            'type' => 'checkbox',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'red' => 'Red',
                'blue' => 'Blue',
                'green' => 'Green',
            ),
            'allow_custom' => 0,
            'default_value' => array(),
            'layout' => 'vertical',
            'toggle' => 0,
            'return_format' => 'value',
            'save_custom' => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testConstructorLabelKey()
    {
        $checkbox = new Checkbox('checkbox', null, 'a random key');

        $checkbox->setChoices([
            'red' => 'Red',
            'green' => 'Green',
            'blue' => 'Blue',
        ]);

        $result = $checkbox->build();

        $expected = [
            'key' => 'field_a_random_key',
            'label' => 'Checkbox',
            'name' => 'checkbox',
            'type' => 'checkbox',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'red' => 'Red',
                'blue' => 'Blue',
                'green' => 'Green',
            ),
            'allow_custom' => 0,
            'default_value' => array(),
            'layout' => 'vertical',
            'toggle' => 0,
            'return_format' => 'value',
            'save_custom' => 0,
        ];

        $this->assertEquals($expected, $result);
    }
}
