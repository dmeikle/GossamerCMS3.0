<?php

namespace Gossamer\Core\System;

use Gossamer\Core\Http\Requests\HttpRequest;
use Gossamer\Core\MVC\Factories\SpawnFactory;
use Gossamer\Essentials\Configuration\SiteParams;
use Gossamer\Set\Utils\Container;


//TODO: refactor this class to use caching

class Application
{
    private $services = array();

    private  $factory;

    public function __construct(SiteParams $params, Container $container, HttpRequest $httpRequest) {
        $this->factory = new SpawnFactory($container, $httpRequest);
        $config = loadConfig($params->getConfigPath() . 'modules.yml');

        $this->init($config, $container, $httpRequest);
    }

    private function init(array $config,Container $container, HttpRequest $httpRequest) {

        foreach($config['components'] as $component) {

            $path = $component . '\Providers\ModuleProvider';

            if(class_exists($path)) {
                $module = $this->factory->spawn($path);
                $services = $module->register();
                $this->registerServices($services);
            }
        }
    }

    private function registerServices(array $serviceConfigs) {
        foreach ($serviceConfigs as $serviceConfig) {
            $interface = null;
            $class = null;
            if(count($serviceConfig) > 1) {
                $interface = $serviceConfig[0];
                $class = $serviceConfig[1];
            }else{
                $interface = $serviceConfig[0];
                $class = $serviceConfig[0];
            }

            $this->services[$interface] = $class;
        }
    }
}