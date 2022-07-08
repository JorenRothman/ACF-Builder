<?php

namespace Joren\ACFBuilder\Util;

abstract class StringUtil
{
    public static function nameFormat(string $string): string
    {
        $string = str_replace('-', '', $string);

        $string = self::removeDuplicates($string);

        return str_replace([' '], '_', strtolower($string));
    }

    private static function removeDuplicates(string $string): string
    {
        $stringArray = explode(' ', $string);

        $stringArray = array_filter($stringArray, function ($stringBit) {
            return $stringBit !== '';
        });

        return implode(' ', $stringArray);
    }
}
