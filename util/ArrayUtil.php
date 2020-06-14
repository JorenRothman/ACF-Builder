<?php

namespace ACFBuilder\Util;

class ArrayUtil
{
    public static function snakeCase(array $array): array
    {
        return array_map(
            function ($item) {
                if (is_array($item)) {
                    $item = self::snakeCase($item);
                }

                return $item;
            },
            self::doSnakeCase($array)
        );
    }

    private static function doSnakeCase(array $array): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            $key = strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $key));

            $result[$key] = $value;
        }

        return $result;
    }
}
