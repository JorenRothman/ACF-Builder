<?php

use Joren\ACFBuilder\Fields\Basic\Text;
use PHPUnit\Framework\TestCase;


final class TextTest extends TestCase
{
    public function testConstructor()
    {
        $field = new Text('A nice Label NAME', 'Name', 'Key');

        $this->assertEquals('A nice Label NAME', $field->label);
        $this->assertEquals('name', $field->name);
        $this->assertEquals('field_Key', $field->key);
        $this->assertEquals('text', $field->type);

        $field = new Text('A nice Label NAME');

        $this->assertEquals('A nice Label NAME', $field->label);
        $this->assertEquals('a_nice_label_name', $field->name);
        $this->assertEquals('field_a_nice_label_name', $field->key);
        $this->assertEquals('text', $field->type);
    }
}
