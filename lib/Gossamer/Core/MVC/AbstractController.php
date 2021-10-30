<?php

namespace Gossamer\Core\MVC;

use Components\Users\DTOs\UserDTO;
use Gossamer\Core\Http\Responses\AbstractResponse;
use Gossamer\Core\MVC\Contracts\ModelInterface;
use Gossamer\Core\MVC\Contracts\ViewInterface;
use Gossamer\Core\System\Traits\EntityManagerTrait;
use Gossamer\Core\Util\JsonMapper;
use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Horus\Http\HttpResponse;
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

    protected $view;

    protected $httpRequest;

    protected $httpResponse;


    public function setView(ViewInterface $view) {
        $this->view = $view;
    }
    protected function render(AbstractResponse $data) {

        $rendered =  $this->view->render($data->getBody());

        return $data->setBody($rendered);
    }

    public function execute() {
        return $this->render(['test']);
    }

    public function listall( $offset,  $limit) {
        $this->render(['it was a list']);
    }
}