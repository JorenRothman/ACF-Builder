<?php

namespace ACFBuilder\Util;

class ObjectUtil
{
    public static function toArray($object)
    {
        return json_decode(json_encode($object), true);
    }
}
