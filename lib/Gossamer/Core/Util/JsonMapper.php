<?php

namespace Gossamer\Core\Util;


class JsonMapper
{

    const PRIMARIES = ['string','int', 'bool','void','null', 'float'];

    public static function toJson($object)
    {

        $retval = self::iterate($object);


      return json_encode($retval, JSON_PRETTY_PRINT);
    }


    private static function iterate($object)
    {

        $reflection = new \ReflectionObject($object);

        $methods = $reflection->getMethods();

        $retval = [];

        foreach($methods as $method) {
            if ($method->getName() == '__construct' || $method->getName() == '__toString') {
                continue;
            }
            $reflectionMethod = new \ReflectionMethod($object, $method->name);

            $key = lcfirst(substr($method->name, 3));
            $returnType = $reflectionMethod->getReturnType();
            //deal with the basic return types
            if($reflectionMethod->hasReturnType() && in_array($returnType->getName(), self::PRIMARIES) ) {
                try{
                    $retval[$key] = $reflectionMethod->invoke($object);
                }catch (\TypeError $e){}
            } elseif($reflectionMethod->hasReturnType() && $returnType->getName() == 'array' ) {
                $items = $reflectionMethod->invoke($object);
                $subElements = [];
                foreach ($items as $item) {
                    $subElements[] = self::iterate($item);
                }
                $retval[$key] = $subElements;
            }
        }

        return $retval;
    }
}
