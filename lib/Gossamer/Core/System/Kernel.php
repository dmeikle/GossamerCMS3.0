<?php

namespace Gossamer\Core\System;

use Gossamer\Core\Http\Requests\HttpRequest;
use Gossamer\Core\Http\Responses\FailResponse;
use Gossamer\Horus\EventListeners\DispatchStates;
use Gossamer\Horus\EventListeners\Event;
use Gossamer\Horus\EventListeners\EventDispatcher;
use Gossamer\Horus\EventListeners\EventDispatcherTrait;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Horus\Http\Traits\HttpRequestTrait;
use Gossamer\Horus\Http\Traits\HttpResponseTrait;
use Gossamer\Set\Utils\Container;
use Gossamer\Set\Utils\Traits\ContainerTrait;

class Kernel
{


    use HttpRequestTrait;
    use HttpResponseTrait;
    use ContainerTrait;
    use EventDispatcherTrait;

    public function __construct(HttpRequest $httpRequest, HttpResponse $httpResponse, Container $container, EventDispatcher $eventDispatcher)
    {
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->container = $container;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function run(array $nodeConfig)
    {
        //TODO: refactor this to use a factory for various contexts
        $kernel = new ServerKernelContext($this->httpRequest, $this->httpResponse, $this->container);

        try {
            $event = new Event('yml');
            $this->eventDispatcher->dispatch($this->httpRequest->getYmlKey(), DispatchStates::STATE_REQUEST_START, $event);
            return $kernel->execute($nodeConfig);
            $this->eventDispatcher->dispatch($this->httpRequest->getYmlKey(), DispatchStates::STATE_REQUEST_COMPLETE, $event);
        } catch (\Exception $exception) {
            return (new FailResponse())
                ->setBody($exception->getMessage());
        }

    }
}