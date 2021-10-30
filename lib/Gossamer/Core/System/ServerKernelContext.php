<?php

namespace Gossamer\Core\System;

use Gossamer\Core\Http\Requests\HttpRequest;

use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Set\Utils\Container;

class ServerKernelContext
{
    private $httpRequest;

    private $httpResponse;

    private $container;

    public function __construct(HttpRequest $httpRequest, HttpResponse $httpResponse, Container $container)
    {
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->container = $container;
    }

    public function execute(array $nodeConfig) {
        $implicitLoader = new \Gossamer\Core\Loading\ImplicitLoader($this->httpRequest, $this->container);
        $implicitLoader->load();

        $componentName = $nodeConfig[$this->httpRequest->getRequestParams()->getYmlKey()]['defaults']['component'];
        if (isset($nodeConfig[$this->httpRequest->getRequestParams()->getYmlKey()]['mocked']) &&
            $nodeConfig[$this->httpRequest->getRequestParams()->getYmlKey()]['mocked'] == 'true') {
            $componentName = '\Gossamer\Core\MVC\MockedComponent';
        }

        $controllerName = $nodeConfig[$this->httpRequest->getRequestParams()->getYmlKey()]['defaults']['controller'];
        $modelName = $nodeConfig[$this->httpRequest->getRequestParams()->getYmlKey()]['defaults']['model'];
        $viewName = $nodeConfig[$this->httpRequest->getRequestParams()->getYmlKey()]['defaults']['view'];
        $method = $nodeConfig[$this->httpRequest->getRequestParams()->getYmlKey()]['defaults']['method'];

        $component = new $componentName($controllerName, $viewName, $modelName,
            $this->container->get('Logger'), $this->httpRequest->getRequestParams()->getLayoutType(), $method,
            $this->httpRequest->getRequestParams()->getRequestParameters());
        $component->setContainer($this->container);

        return $component->handleRequest($this->httpRequest, $this->httpResponse);
    }
}