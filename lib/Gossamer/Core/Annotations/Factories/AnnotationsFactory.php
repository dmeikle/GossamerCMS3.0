<?php

namespace Gossamer\Core\Annotations\Factories;

use Components\Users\Controllers\UsersController;

class AnnotationsFactory
{

    public static function injectAnnotations(object $object) {
        $name = get_class($object);
        echo $name;
        $reflection = new \ReflectionClass(UsersController::class);
    //    pr($reflection->getAttributes());
    }
}