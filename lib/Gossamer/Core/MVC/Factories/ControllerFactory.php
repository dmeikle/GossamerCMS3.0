<?php
namespace Gossamer\Core\MVC\Factories;

use Gossamer\Core\MVC\AbstractController;
use Gossamer\Set\Utils\Container;
use Gossamer\Set\Utils\Traits\ContainerTrait;
use ReflectionMethod;

class ControllerFactory
{
    use ContainerTrait;

    private $objectFactory;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->objectFactory = new ObjectFactory($container);
    }

    public  function getArguments(string $controllerName, string $method)  {

        $arguments = self::createArgumentMetadata([$controllerName, $method]);

        return $arguments;

        if(is_null($arguments)) {
            return null;
        }

        return $this->objectFactory->getObjects($arguments);
    }

    public  function createArgumentMetadata($controller): array
    {
        $arguments = [];
pr($controller);
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

    public function getConstructorArguments( $controllerName, ?string $method)
    {

        $reflection = new \ReflectionClass($controllerName);
        $constructor = $reflection->getConstructor();
        pr($constructor);
        pr($constructor->getParameters());
        $arguments = $this->createArgumentMetadata([$controllerName, '__construct']);
        pr($arguments);

    }

    public function spawn($name, $method) {
        echo "constructorargs\r\n";
        $constructorArgNames = $this->getArguments($name, '__construct');
        echo "methodargs\r\n";
        $methodArgs = $this->getArguments($name, $method);
        $args = array();
        foreach ($constructorArgNames as $argName) {
            $args[] = $this->spawn($argName->getType(), '__construct');
        }

        $refClass = new ReflectionClass($name);

        return $refClass->newInstanceArgs((array) $args);
    }
}
/*
 * $params = $refMethod->getParameters();

        $re_args = array();

        foreach($params as $key => $param)
        {
            if ($param->isPassedByReference())
            {
                $re_args[$key] = &$args[$key];
            }
            else
            {
                $re_args[$key] = $args[$key];
            }
        }
*/