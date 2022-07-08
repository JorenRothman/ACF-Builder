<?php

use Joren\ACFBuilder\Util\StringUtil;
use PHPUnit\Framework\TestCase;

class StringUtilTest extends TestCase
{
    public function testNameFormat()
    {
        $this->assertEquals('my_field_group_test', StringUtil::nameFormat('My Field Group - Test'));

        $this->assertEquals('my_custom_name_field', StringUtil::nameFormat('my custom name -_----- field'));

        $this->assertEquals('my_custom_name_field', StringUtil::nameFormat('my custom name field'));
    }
}
