<?php

namespace ACFBuilder\Util;

class StringBuilder
{
    private $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function toSnakeCase()
    {
        $string = strtolower($this->string);

        $string = str_replace('-', '', $string);
        $string = str_replace(' ', '_', $string);
        $string = str_replace('__', '_', $string);

        return $string;
    }
}
