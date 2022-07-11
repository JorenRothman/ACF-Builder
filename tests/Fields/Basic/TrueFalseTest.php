<?php

use Joren\ACFBuilder\Fields\TrueFalse;
use PHPUnit\Framework\TestCase;


final class TrueFalseTest extends TestCase
{
    public function testConstructor()
    {
        $field = new TrueFalse('A nice Label NAME', 'Name', 'Key');

        $this->assertEquals('A nice Label NAME', $field->label);
        $this->assertEquals('name', $field->name);
        $this->assertEquals('field_Key', $field->key);
        $this->assertEquals('true_false', $field->type);

        $field = new TrueFalse('A nice Label NAME');

        $this->assertEquals('A nice Label NAME', $field->label);
        $this->assertEquals('a_nice_label_name', $field->name);
        $this->assertEquals('field_a_nice_label_name', $field->key);
        $this->assertEquals('true_false', $field->type);
    }
}
