<?php

namespace Gossamer\Core\MVC\Factories;

use Gossamer\Set\Utils\Container;
use Gossamer\Set\Utils\Traits\ContainerTrait;
use ReflectionClass;

class ObjectFactory
{
    use ContainerTrait;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public  function getObject(ArgumentMetadata $argumentMetadata) {
        if($argumentMetadata->getType() == 'int') {
            return ;
        }

        $name=  $argumentMetadata->getType();
        $reflection = new ReflectionClass($name);
        $parameters = $reflection->getConstructor()->getParameters();
        $containerParams = array();
        foreach($parameters as $parameter) {
            if($parameter->getName() == 'attributes') {
                continue;
            }
            $containerParams[] = $this->container->get($parameter->getType()->getName());
        }
        $object = $reflection->newInstanceArgs($containerParams);

        $traits = class_uses_deep($object);

        if(in_array('Gossamer\Horus\Http\Traits\HttpRequestTrait', $traits)) {
            $object->setHttpRequest($this->container->get('HttpRequest'));
        }
        if(in_array('Gossamer\Horus\Http\Traits\HttpResponseTrait', $traits)) {
            $object->setHttpRequest($this->container->get('HttpResponse'));
        }
        if(in_array('Gossamer\Set\Utils\Traits\ContainerTrait', $traits)) {
            $object->setContainer($this->container);
        }
        if(in_array('Gossamer\Set\Utils\Traits\ContainerTrait', $traits)) {
            $object->setContainer($this->container);
        }
        if(in_array('Gossamer\Neith\Logging\Traits\LoggingTrait', $traits)) {
            $object->setLogger($this->container->get('Logger'));
        }


        return $object;
    }

    public function getObjects(array $argumentMetadatas) {
        $retval = array();
        foreach ($argumentMetadatas as $argumentMetadata) {
            if(!is_null($argumentMetadata)) {
                $retval[] = $this->getObject($argumentMetadata);
            }
        }

        return $retval;
    }
}