<?php

namespace ACFBuilder\Util;

class StringUtil
{
    public static function snake($value, $delimiter = null)
    {
        if (!\ctype_lower($value)) {
            $value = (string) \preg_replace('/\s+/u', '', \ucwords($value));
            $value = (string) \mb_strtolower(\preg_replace(
                '/(.)(?=[A-Z])/u',
                '$1' . ($delimiter ?? '_'),
                $value
            ));
        }

        $value = str_replace('-', '', $value);

        return $value;
    }

    public static function hash($value)
    {
        return hash('md5', $value);
    }
}
