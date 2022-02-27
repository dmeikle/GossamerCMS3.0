<?php

namespace tests\helpers;


use Gossamer\Core\Http\Requests\HttpRequest;
use Gossamer\Core\MVC\AbstractService;
use Gossamer\Core\MVC\Factories\SpawnFactory;
use Gossamer\Core\System\EntityManager;
use Gossamer\Essentials\Configuration\SiteParams;
use Gossamer\Horus\Http\HttpResponse;
use Gossamer\Horus\Http\RequestParams;
use Gossamer\Set\Utils\Container;

class TestCase extends \PHPUnit\Framework\TestCase
{

    use JsonResponseHelper;

    protected function getService(string $classPath
    ): AbstractService {
        $httpRequest = new HttpRequest(new RequestParams(), new SiteParams());
        $spawnFactory = new SpawnFactory(
            $this->getContainer($httpRequest),
            $httpRequest
        );
        return $spawnFactory->spawn($classPath);
//        return new $classPath(
//            new Container(),
//            new EntityManager(
//                [
//                    'default' => [
//                        'host' => 'localhost',
//                        'username' => 'goss3_user',
//                        'password' => 'dh7djsdk4',
//                        'dbName' => 'gossamer3'
//                    ]
//                ]
//            ),
//            new HttpRequest(new RequestParams(), new SiteParams()
//            ),
//            new HttpResponse(),
//            buildLogger()
//        );
    }

    protected function getContainer(HttpRequest $httpRequest) : Container {

        $bootstrapLoader = new \Gossamer\Core\System\BootstrapLoader();
        $entityManager = $bootstrapLoader->getEntityManager(__CONFIG_PATH);
        $logger = buildLogger();

        $httpResponse = new \Gossamer\Horus\Http\HttpResponse();
        $container = new \Gossamer\Set\Utils\Container();
        $container->set('Logger', $logger, 'Gossamer\Neith\Logging\LoggingInterface');
        $container->set('EntityManager', $entityManager, 'Gossamer\Core\System\EntityManager');
        $cacheManager = new \Gossamer\Caching\CacheManager($logger);
        $cacheManager->setHttpRequest($httpRequest);
        $container->set('CacheManager', $cacheManager, 'Gossamer\Caching\CacheManager');
        $container->set('HttpRequest', $httpRequest, 'Gossamer\Horus\Http\HttpRequest');
        $container->set('HttpResponse', $httpResponse, 'Gossamer\Horus\Http\HttpResponse');

//        $application = new \Gossamer\Core\System\Application($siteParams, $container, $httpRequest);
//        $container->set('Application', $application);
        return $container;
    }

    protected function GUID() : string
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    protected function getHttpRequest() : HttpRequest {
        return new
        HttpRequest(
            new RequestParams(),
            new SiteParams()
        );
    }
}
