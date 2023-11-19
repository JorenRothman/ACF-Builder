<?php

namespace JorenRothman\ACFBuilder\Util;

/**
 * Class StringUtil
 * 
 * @package JorenRothman\ACFBuilder\Util
 */
abstract class StringUtil
{
    /**
     * Format a string to be used as a field name.
     *
     * @param string $value
     * @return string
     */
    public static function nameFormat(string $string): string
    {
        // Replace spaces with underscores.
        $string = str_replace('-', '', $string);

        $string = str_replace(' ', '_', strtolower($string));

        $string = preg_replace('/_+/', '_', $string);

        return $string;
    }
}
