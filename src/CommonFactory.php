<?php

namespace Helpers;

use ReflectionClass;
use ReflectionException;

interface CommonFactoryInterface
{
    public static function createObject(string $className, $args = null): object;
}

class CommonFactory
    implements CommonFactoryInterface
{
    /** Returns object or null by ClassName
     * @param string $className
     * @param array|null $args
     * @return object
     */
    public static function createObject(string $className, $args = null): object
    {
        try {
            $class = new ReflectionClass($className);
        } catch (ReflectionException $re) {
            return $re;
        }

        if ($class->getConstructor() === null) {
            return new $className($args);
        } else {
            $args = is_array($args) ? $args : [];
            return $class->newInstanceArgs($args);
        }
    }
}
