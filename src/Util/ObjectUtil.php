<?php

namespace JorenRothman\ACFBuilder\Util;

/**
 * Class ObjectUtil
 *
 * @package JorenRothman\ACFBuilder\Util
 */
abstract class ObjectUtil
{
    /**
     * Convert the public properties of an object to an array, like json_decode(json_encode($object), true).
     *
     * Properties in $except are set to null without being encoded, so callers can fill in
     * child objects they build themselves without serializing the whole subtree first.
     *
     * @param object $object
     * @param string[] $except
     * @return array
     */
    public static function toArray(object $object, array $except = []): array
    {
        // Called outside the object's class scope, so only public properties are returned.
        $properties = get_object_vars($object);

        foreach ($except as $property) {
            if (array_key_exists($property, $properties)) {
                $properties[$property] = null;
            }
        }

        return json_decode(json_encode($properties), true);
    }
}
