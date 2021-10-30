<?php

namespace Gossamer\Core\Util;

class JsonMapper
{

    public static function toJson($object)
    {
        $retval = null;

        if (is_array($object)) {
            $retval = array();
            foreach ($object as $item) {
                $retval[] = self::iterate($item);
            }
        } else {
            $retval = self::iterate($object);
        }

        return json_encode($retval);
    }

    private static function iterate($object)
    {

        if (is_null($object) || !is_object($object)) {
            return $object;
        }
        $reflection = new \ReflectionObject($object);

        $methods = $reflection->getMethods();
        $retval = array();

        foreach ($methods as $method) {

            if ($method->name == '__construct' || $method->name == 'toString') {
                continue;
            }
            $reflectionMethod = new \ReflectionMethod($object, $method->name);

            $key = lcfirst(substr($method->name, 3));
            $returnType = $reflectionMethod->getReturnType();


            if (!is_null($returnType) && is_object($reflectionMethod->getReturnType())) {
                $retval[$key] = self::iterate($reflectionMethod->invoke($object));
            } else {
                $retval[$key] = $reflectionMethod->invoke($object);
            }

        }

        return $retval;
    }
}