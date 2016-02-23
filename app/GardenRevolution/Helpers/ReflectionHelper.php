<?php

namespace App\GardenRevolution\Helpers;

use Exception;

use ReflectionClass;

class ReflectionHelper
{
    public static function getShortName($object)
    {
        if( ! is_object($object) )
        {
            throw new Exception('Parameter passed is not an object');
        }

        else
        {
            $namespace = get_class($object);
            $reflection = new ReflectionClass($namespace);

            return $reflection->getShortName();
        }
    }
}
