<?php

use Joren\ACFBuilder\FieldGroup;
use PHPUnit\Framework\TestCase;


final class FieldGroupTest extends TestCase
{
    public function testTitle()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test');

        $this->assertEquals('My Field Group - Test', $fieldGroup->title);
        $this->assertEquals('my_field_group_test', $fieldGroup->name);

        $this->assertNotEmpty($fieldGroup->key);
    }

    public function testName()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test', 'my custom name field');

        $this->assertEquals('My Field Group - Test', $fieldGroup->title);
        $this->assertEquals('my_custom_name_field', $fieldGroup->name);

        $this->assertNotEmpty($fieldGroup->key);
    }

    public function testKey()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test', 'my custom name field', 'randodkfhashgohrijaipaf');

        $this->assertEquals('My Field Group - Test', $fieldGroup->title);
        $this->assertEquals('my_custom_name_field', $fieldGroup->name);

        $this->assertNotEmpty($fieldGroup->key);
    }

    public function testBuild()
    {
        $fieldGroup = new FieldGroup('My Field Group - Test');

        $this->assertIsArray($fieldGroup->build());

        $this->assertEquals([
            'title' => 'My Field Group - Test',
            'name' => 'my_field_group_test',
            'key' => '40c17d408c7dff2f69957d263562188e',
        ], $fieldGroup->build());
    }
}
