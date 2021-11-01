<?php

namespace Gossamer\Core\MVC;

use Gossamer\Core\Http\Responses\AbstractResponse;
use Gossamer\Core\MVC\Contracts\ViewInterface;
use Gossamer\Core\System\Traits\EntityManagerTrait;
use Gossamer\Horus\EventListeners\DispatchStates;
use Gossamer\Horus\EventListeners\Event;
use Gossamer\Horus\EventListeners\EventDispatcher;
use Gossamer\Horus\EventListeners\EventDispatcherTrait;
use Gossamer\Horus\Http\Traits\HttpRequestTrait;
use Gossamer\Horus\Http\Traits\HttpResponseTrait;
use Gossamer\Neith\Logging\LoggingInterface;
use Gossamer\Set\Utils\Traits\ContainerTrait;
use Gossamer\Neith\Logging\Traits\LoggingTrait;

class AbstractController
{
    use ContainerTrait;

    use EntityManagerTrait;

    use HttpRequestTrait;

    use HttpResponseTrait;

    use LoggingTrait;

    use EventDispatcherTrait;

    protected $view;

    protected $httpRequest;

    protected $httpResponse;

    public function __construct(EventDispatcher $eventDispatcher, LoggingInterface $logger)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    public function setView(ViewInterface $view)
    {
        $this->view = $view;
    }

    protected function render(AbstractResponse $data)
    {
        $event = new Event($this->httpRequest->getYmlKey(), $data);
        $this->eventDispatcher->dispatch($this->httpRequest->getYmlKey(),
            DispatchStates::STATE_BEGIN_VIEW, $event);
        $rendered = $this->view->render($data->getBody());
        $this->eventDispatcher->dispatch($this->httpRequest->getYmlKey(),
            DispatchStates::STATE_END_VIEW, $event);

        return $data->setBody($rendered);
    }

    public function execute()
    {
        return $this->render(['test']);
    }

    public function listall($offset, $limit)
    {
        $this->render(['it was a list']);
    }
}