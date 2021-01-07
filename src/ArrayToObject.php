<?php

namespace Rayblair\ArrayToObject;

use stdClass;

class ArrayToObject
{
    public static function convert(array $array)
    {
        $object = new stdClass;

        foreach ($array as $property => $value) {
            if (is_array($value)) {
                $value = static::convert($value);
            }

            $object->{$property} = $value;
        }

        return $object;
    }
}
