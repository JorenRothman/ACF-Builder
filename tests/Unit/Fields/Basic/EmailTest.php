<?php

use JorenRothman\ACFBuilder\FieldConditionalLogic;
use JorenRothman\ACFBuilder\Fields\Basic\Email;
use JorenRothman\ACFBuilder\Fields\Choice\TrueFalse;
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

    public function testMake()
    {
        $email = Email::make('Contact', 'contact_email');

        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals('field_contact_email', $email->key);
        $this->assertEquals('contact_email', $email->name);
    }

    public function testBuildIsIdempotent()
    {
        $email = new Email('Email');

        $this->assertEquals($email->build(), $email->build());
        $this->assertEquals('field_email', $email->key);
    }

    public function testBuildSerializesConditionalLogic()
    {
        $trigger = new TrueFalse('Active');
        $email   = new Email('Email');

        $logic = new FieldConditionalLogic();
        $logic->and($trigger, '==', true);
        $email->setConditionalLogic($logic);

        $result = $email->build();

        $this->assertEquals([
            [['field' => 'field_active', 'operator' => '==', 'value' => '1']],
        ], $result['conditional_logic']);

        // FieldConditionalLogic object must not be replaced — second build still works
        $this->assertEquals($result, $email->build());
    }
}
