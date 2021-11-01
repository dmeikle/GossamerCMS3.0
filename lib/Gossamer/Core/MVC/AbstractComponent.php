<?php

namespace Gossamer\Core\MVC;

use Components\Users\Models\User;
use Gossamer\Core\Annotations\Factories\AnnotationsFactory;
use Gossamer\Core\Exceptions\HandlerNotCallableException;
use Gossamer\Core\Exceptions\KeyNotSetException;
use Gossamer\Core\MVC\Factories\ControllerFactory;
use Gossamer\Core\MVC\Factories\ObjectFactory;
use Gossamer\Core\MVC\Factories\SpawnFactory;
use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Neith\Logging\LoggingInterface;

abstract class AbstractComponent
{
    use \Gossamer\Set\Utils\Traits\ContainerTrait;

    private ?string $controllerName = null;

    private ?string $modelName = null;

    private ?string $method = null;

    private ?array $params = null;

    private ?LoggingInterface $logger = null;

    private string $viewName;

    private array $agentType;

    private array $services = array();


    /**
     *
     * @param string $controllerName
     * @param string $viewName
     * @param string $modelName
     * @param string $method
     * @param array $params
     * @param Logger $logger
     * @param array $agentType
     *
     * @throws ParameterNotPassedException
     */
    public function __construct(string $controllerName, string $viewName, string $modelName, LoggingInterface $logger, array $agentType, $method = null, array $params = null) {

        if (is_null($controllerName)) {
            throw new KeyNotSetException('controller name is null');
        } else if (is_null($modelName)) {
            throw new KeyNotSetException('model is null');
        }
        $this->controllerName = $controllerName;

        $this->viewName = $viewName;

        $this->modelName = $modelName;

        $this->method = $method;

        $this->params = $params;

        $this->logger = $logger;

        $this->agentType = $agentType;

    }


    /**
     * @param HttpRequest $httpRequest
     * @param HttpResponse $httpResponse
     * @return mixed
     * @throws HandlerNotCallableException
     */
    public function handleRequest(HttpRequest &$httpRequest, HttpResponse &$httpResponse) {


        //if it throws an exception we are catching it in the calling Kernel
        if (is_callable($this->controllerName,$this->method)) {

            $view = new $this->viewName($this->logger, $httpRequest->getRequestParams()->getYmlKey(), $this->agentType, $httpRequest, $httpResponse);
            $view->setContainer($this->container);

            $spawnFactory = new SpawnFactory($this->container, $httpRequest);
            $controller = $spawnFactory->spawn($this->controllerName);
            $controller->setView($view);
            $arguments = $spawnFactory->getArguments($controller, $this->method);
            $implicitParameters = $httpRequest->getImplicitParameters();

            $mergedParameters = $this->mergeParameters($httpRequest, $implicitParameters, $arguments);

            return call_user_func_array(array(
                $controller,
                $this->method
            ), $mergedParameters);
        } else {
           throw new HandlerNotCallableException('unable to match method ' . $this->method . ' to controller with key: ' . $httpRequest->getRequestParams()->getYmlKey());
        }

    }

    private function mergeParameters(HttpRequest $httpRequest, array $implicitParameters, array $arguments)
    {
        //implicitParameters has precedent
        return array_replace($arguments, $httpRequest->getRequestParams()->getUriParameters(), $implicitParameters);

    }

    protected function getChildNamespace() {
        return substr(get_called_class(), 0, strrpos(get_called_class(), '\\'));
    }

    protected function bind($abstract, $concrete = null) {
        $this->container->bind($abstract, $concrete);
    }

    public function getBinding(string $key) {
        return $this->container->getBinding($key);
    }

}