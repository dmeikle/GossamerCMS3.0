<?php

namespace Gossamer\Core\Routing;

use Gossamer\Core\Routing\Exceptions\ConfigurationNotFoundException;
use Gossamer\Horus\Http\HttpRequest;
use Gossamer\Neith\Logging\LoggingInterface;

class RoutingService
{
    use \Gossamer\Core\Configuration\Traits\LoadConfigurationTrait;

    public function getRouting(LoggingInterface $logger, HttpRequest &$httpRequest) {
        $router = $this->getRouterType($logger, $httpRequest);

        $currentNode = $router->getCurrentNode();

        return $currentNode;
    }

    private function getRouterType(LoggingInterface $logger, HttpRequest $httpRequest) {
        $config = $this->loadConfig($httpRequest->getSiteParams()->getConfigPath() . 'config.yml');
        if(!array_key_exists('server_context', $config)) {
            throw new ConfigurationNotFoundException('server_context missing from application config');
        }

        if($config['server_context'] === 'database') {

            return new DBRouter($logger, $httpRequest);
        }

        return new Router($logger, $httpRequest);
    }
}