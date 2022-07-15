<?php

use Joren\ACFBuilder\Fields\Basic\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testConstructorLabel()
    {
        $email = new Email('Email');

        $result = $email->build();

        $expected = [
            'key' => 'field_email',
            'label' => 'Email',
            'name' => 'email',
            'type' => 'email',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testConstructorLabelName()
    {
        $email = new Email('Email', 'email_thing');

        $result = $email->build();

        $expected = [
            'key' => 'field_email_thing',
            'label' => 'Email',
            'name' => 'email_thing',
            'type' => 'email',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testConstructorLabelNameKey()
    {
        $email = new Email('Email', 'email_name', 'a random key');

        $result = $email->build();

        $expected = [
            'key' => 'field_a_random_key',
            'label' => 'Email',
            'name' => 'email_name',
            'type' => 'email',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testConstructorLabelKey()
    {
        $email = new Email('Email', null, 'a random 1 key');

        $result = $email->build();

        $expected = [
            'key' => 'field_a_random_1_key',
            'label' => 'Email',
            'name' => 'email',
            'type' => 'email',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
            ],
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ];

        $this->assertEquals($expected, $result);
    }
}
