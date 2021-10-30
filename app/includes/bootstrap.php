<?php
$logger = buildLogger($siteParams);

$container = new \Gossamer\Set\Utils\Container();
$bootstrapLoader = new \Gossamer\Core\System\BootstrapLoader();

$httpRequest = new Gossamer\Core\Http\Requests\HttpRequest($bootstrapLoader->getRequestParams(), $siteParams);

//response if for all parameters to be sent out upon completion of request.
//place all values intended for 'sending' in here
$httpResponse = new \Gossamer\Horus\Http\HttpResponse();

//sets it inside the httpRequest object
$routingService = new \Gossamer\Core\Routing\RoutingService();

//inside this getRouting call is where we determine the yml key
$nodeConfig = $routingService->getRouting($logger, $httpRequest);

//now we can finally set the yml key for this request
$httpRequest->getRequestParams()->setYmlKey($nodeConfig['ymlKey']);
$entityManager = $bootstrapLoader->getEntityManager($httpRequest->getSiteParams()->getConfigPath());

$container = new \Gossamer\Set\Utils\Container();
$container->set('Logger', $logger, 'Gossamer\Neith\Logging\LoggingInterface');
$container->set('EntityManager', $entityManager, 'Gossamer\Core\System\EntityManager');
$cacheManager = new \Gossamer\Caching\CacheManager($logger);
$cacheManager->setHttpRequest($httpRequest);
$container->set('CacheManager', $cacheManager, 'Gossamer\Caching\CacheManager');
$container->set('HttpRequest', $httpRequest, 'Gossamer\Horus\Http\HttpRequest');
$container->set('HttpResponse', $httpResponse, 'Gossamer\Horus\Http\HttpResponse');

$application = new \Gossamer\Core\System\Application($siteParams, $container, $httpRequest);
$container->set('Application', $application);

$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection([
    "driver" => "mysql",
    "host" =>"127.0.0.1",
    "database" => "gossamer3",
    "username" => "goss3_user",
    "password" => "dh7djsdk4"
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

