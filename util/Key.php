<?php

namespace ACFBuilder\Util;

class Key
{
    public function create($namespace, $title)
    {
        $key = [];

        if (!empty($namespace) && strpos($title, $namespace) === false) {
            $namespaceString = new StringBuilder($namespace);

            array_push($key, $namespaceString->toSnakeCase());
        }

        $string = new StringBuilder($title);

        $title = $string->toSnakeCase();

        array_push($key, $title);

        return implode('_', $key);
    }
}
