<?php

use Joren\ACFBuilder\Fields\Text;
use PHPUnit\Framework\TestCase;


final class TextTest extends TestCase
{
    public function testConstructor()
    {
        $field = new Text('A nice Label NAME', 'Name', 'Key');

        $this->assertEquals('A nice Label NAME', $field->label);
        $this->assertEquals('name', $field->name);
        $this->assertEquals('897356954c2cd3d41b221e3f24f99bba', $field->key);
        $this->assertEquals('text', $field->type);

        $field = new Text('A nice Label NAME');

        $this->assertEquals('A nice Label NAME', $field->label);
        $this->assertEquals('a_nice_label_name', $field->name);
        $this->assertEquals('9cce016c55ac67d739003eadc94d547e', $field->key);
        $this->assertEquals('text', $field->type);
    }
}
