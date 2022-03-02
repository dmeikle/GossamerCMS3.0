<?php

namespace Gossamer\Core\Loading;

use Gossamer\Core\MVC\Factories\SpawnFactory;
use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Horus\Http\Traits\HttpRequestTrait;
use Gossamer\Pesedget\Database\Exceptions\RecordNotFoundException;
use Gossamer\Set\Utils\Container;
use Gossamer\Set\Utils\Traits\ContainerTrait;

class ImplicitLoader
{

    use HttpRequestTrait;
    use ContainerTrait;

    private $spawnFactory;

    public function __construct(HttpRequest $httpRequest, Container $container) {
        $this->httpRequest = $httpRequest;
        $this->container = $container;
        $this->spawnFactory = new SpawnFactory($container, $httpRequest);
    }

    public function load() {
        $params = $this->httpRequest->getNodeConfig();

        if(array_key_exists('implicitKeys', $params[$this->httpRequest->getYmlKey()])) {
            foreach ($params[$this->httpRequest->getYmlKey()]['implicitKeys'] as $implicitKey) {

               foreach($implicitKey as $key => $className) {
                   if($key == 'key') {
                       continue;
                   }

                    $idKey = array_key_exists('key', $implicitKey) ? $implicitKey['key'] : 'id';

                    $item =($className)::where($idKey, $this->httpRequest->getRequestParams()->getUriParameter($key))->first();
                    if(!is_null($item) ) {
                        $this->httpRequest->setImplicitParameter($className, $item);
                    }else {
                        throw new RecordNotFoundException('Unable to locate ' . $key . ' with ' . $idKey . ' ' .
                            $this->httpRequest->getRequestParams()->getUriParameter($key));
                    }
                }
            }
        }
    }

}
