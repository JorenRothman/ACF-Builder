<?php

namespace Joren\ACFBuilder\Util;

/**
 * Class StringUtil
 * 
 * @package Joren\ACFBuilder\Util
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


        $string = self::removeDuplicates($string);


        // Replace spaces with underscores.
        return $string;
    }

    /**
     * Remove duplicate characters from a string.
     * 
     * @param string $string 
     * @return string 
     */
    private static function removeDuplicates(string $string): string
    {
        $stringArray = str_split($string);

        $lastLetter = null;

        $stringArray = array_filter($stringArray, function ($stringBit) use (&$lastLetter) {
            if (is_null($lastLetter)) {
                $lastLetter = $stringBit;

                return true;
            }

            if ($stringBit === $lastLetter && $stringBit === '_') {
                return false;
            }

            $lastLetter = $stringBit;

            return true;
        });

        return implode('', $stringArray);
    }
}
