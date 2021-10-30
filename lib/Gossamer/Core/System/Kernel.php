<?php

namespace Gossamer\Core\System;

use Gossamer\Core\Http\Requests\HttpRequest;
use Gossamer\Core\Http\Responses\FailResponse;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Set\Utils\Container;

class Kernel
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

    public function run(array $nodeConfig)
    {
        //TODO: refactor this to use a factory for various contexts
        $kernel = new ServerKernelContext($this->httpRequest, $this->httpResponse, $this->container);

        try {
            return $kernel->execute($nodeConfig);
        } catch (\Exception $exception) {
            return (new FailResponse())
                ->setBody($exception->getMessage());
        }

    }
}