<?php

namespace Gossamer\Core\MVC\Factories;

use Gossamer\Core\Http\Requests\HttpRequest;
use Gossamer\Horus\Http\Traits\HttpRequestTrait;
use Gossamer\Set\Utils\Container;
use Gossamer\Set\Utils\Traits\ContainerTrait;

class SpawnFactory
{
    use ContainerTrait;

    use HttpRequestTrait;

    public function __construct(Container $container, HttpRequest $httpRequest) {
        $this->container = $container;
        $this->httpRequest = $httpRequest;
    }

    public function spawn(string $name) {
        if(!class_exists($name)) {
            return;
        }

        $reflection = new \ReflectionClass($name);
        $constructor = $reflection->getConstructor();
        $injectors = array();

        if($constructor != null) {
            foreach($constructor->getParameters() as $parameter) {
                if(!is_null($parameter->getType()->getName())) {
                    $item = $this->spawn($parameter->getType()->getName());
                    if(!is_null($item)) {
                        $injectors[] = $item;
                    }
                }
            }
        }
        try{
            $item = $this->locateObject($name);
            if(!is_null($item)) {
                return $item;
            }
        }catch (\Exception $e) {

        }
        try{

            $class = new $name(...array_values($injectors));

            $this->injectTraits($class);

            return $class;
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    private function locateObject(string $name) {
        if($name == 'Gossamer\Essentials\Configuration\SiteParams') {
            return $this->httpRequest->getSiteParams();
        }
        $item = $this->container->get($name);
        if(!is_null($item)) {
            return $item;
        }
        $item = $this->container->get('Application')->get($name);
        if(!is_null($item)) {
            return $item;
        }

        return null;
    }

    public function getArguments($object, string $method) {

        $reflector = new \ReflectionMethod($object, $method);
        $parameters = $reflector->getParameters();

        $arguments = array();
        foreach($parameters as $parameter) {
            if(!is_object($parameter->getType())) {
                continue;
            }
            if(!is_null($parameter->getType()->getName())) {
                $arguments[$parameter->getType()->getName()] = $this->spawn($parameter->getType()->getName());
            }
        }

        return $arguments;
    }

    public  function createArgumentMetadata($controller): array
    {
        $arguments = [];

        if (\is_array($controller) && method_exists($controller[0], $controller[1])) {
            $reflection = new \ReflectionMethod($controller[0], $controller[1]);
        } elseif (\is_object($controller) && !$controller instanceof \Closure) {
            $reflection = (new \ReflectionObject($controller))->getMethod('__invoke');
        } elseif (\is_array($controller)) {
            $reflection = new \ReflectionClass($controller[0]);
        } else {
            $reflection = new \ReflectionFunction($controller[0]);
        }


            foreach ($reflection->getParameters() as $param) {
                $attributes = [];
                if (\PHP_VERSION_ID >= 80000) {
                    foreach ($param->getAttributes() as $reflectionAttribute) {
                        if (class_exists($reflectionAttribute->getName())) {
                            $attributes[] = $reflectionAttribute->newInstance();
                        }
                    }
                }

                $arguments[] = new ArgumentMetadata($param->getName(), self::getType($param, $reflection), $param->isVariadic(), $param->isDefaultValueAvailable(), $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null, $param->allowsNull(), $attributes);
            }

        return $arguments;
    }

    /**
     * Returns an associated type to the given parameter if available.
     */
    private  function getType(\ReflectionParameter $parameter, \ReflectionFunctionAbstract $function): ?string
    {
        if (!$type = $parameter->getType()) {
            return null;
        }
        $name = $type instanceof \ReflectionNamedType ? $type->getName() : (string) $type;

        if ($function instanceof \ReflectionMethod) {
            $lcName = strtolower($name);
            switch ($lcName) {
                case 'self':
                    return $function->getDeclaringClass()->name;
                case 'parent':
                    return ($parent = $function->getDeclaringClass()->getParentClass()) ? $parent->name : null;
            }
        }

        return $name;
    }

    private function injectTraits($object) {
        $traits = class_uses_deep($object);

        if(in_array('Gossamer\Set\Utils\Traits\ContainerTrait', $traits)) {
            $object->setContainer($this->container);
        }
        if(in_array('Gossamer\Core\System\Traits\EntityManagerTrait', $traits)) {
            $object->setEntitymanager($this->container->get('EntityManager'));
        }
        if(in_array('Gossamer\Horus\Http\Traits\HttpRequestTrait', $traits)) {
            $object->setHttpRequest($this->container->get('HttpRequest'));
        }
        if(in_array('Gossamer\Horus\Http\Traits\HttpResponseTrait', $traits)) {
            $object->setHttpResponse($this->container->get('HttpResponse'));
        }
        if(in_array('Gossamer\Neith\Logging\Traits\LoggingTrait', $traits)) {
            $object->setLogger($this->container->get('Logger'));
        }
    }
}