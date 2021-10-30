<?php

namespace Gossamer\Core\Annotations;

#[\Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class Injected
{
    public function __construct(string $objectpath) {
        $object = new $objectpath;
    }
}