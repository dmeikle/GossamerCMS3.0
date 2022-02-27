<?php

use Nzo\UrlEncryptorBundle\Encryptor\Encryptor;

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
$httpRequest->setNodeConfig($nodeConfig);

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
if($siteParams->getSiteConfig()['TEST_MODE'] == 'true') {
    $capsule->addConnection([
        "driver" => "mysql",
        "host" =>"127.0.0.1",
        "database" => "gossamer3_phpunit",
        "username" => "goss3_user",
        "password" => "dh7djsdk4"
    ]);
}else{
    $capsule->addConnection([
        "driver" => "mysql",
        "host" =>"127.0.0.1",
        "database" => "gossamer3",
        "username" => "goss3_user",
        "password" => "dh7djsdk4"
    ]);
}
$capsule->setAsGlobal();
$capsule->bootEloquent();

$siteConfig = loadConfig($httpRequest->getSiteParams()->getConfigPath() . DIRECTORY_SEPARATOR . 'config.yml');
$encryptorConfig = $siteConfig['nzo_encryptor'];

$encryptor = new Encryptor(
    $encryptorConfig['secret_key'],
    $encryptorConfig['cipher_algorithm'],
    $encryptorConfig['base64_encode'],
    $encryptorConfig['format_base64_output'],
    $encryptorConfig['random_pseudo_bytes']
);
$encryptor->setSecretIv($encryptorConfig['secret_iv']);
$container->set('Encryptor', $encryptor, 'Nzo\UrlEncryptorBundle\Encryptor\Encryptor');

//create the event dispatcher before filter service so that we can use it in event of error during filter chain
$dispatchService = new \Gossamer\Core\Services\DispatchService($logger, new \Gossamer\Essentials\Configuration\YamlLoader());
$dispatchService->setHttpRequest($httpRequest);
$dispatchService->setHttpResponse($httpResponse);
$eventDispatcher = $dispatchService->getEventDispatcher(loadConfig($siteParams->getConfigPath() . 'listeners.yml'), $container);

$eventDispatcher->setConfiguration(
    loadConfig($siteParams->getSitePath() . DIRECTORY_SEPARATOR . $nodeConfig['componentPath'] . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'listeners.yml'),
    $httpRequest->getYmlKey());

$container->set('EventDispatcher', $eventDispatcher, 'Gossamer\Horus\EventListeners\EventDispatcher');
//$eventDispatcher->configNodeListeners($httpRequest->getRequestParams()->getUri(),
//    loadConfig($siteParams->getSitePath() . DIRECTORY_SEPARATOR . $nodeConfig['componentPath'] . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'listeners.yml'));
//run through our filters to see if we qualify the request to continue
$filterService = new Gossamer\Horus\Filters\FilterDispatcher($logger);
$filterService->setContainer($container);

//execute any entrypoint filters
runFilters($siteParams->getConfigPath() . 'filters.yml', 'all',\Gossamer\Horus\Filters\FilterEvents::FILTER_ENTRY_POINT);

//check for immediate write here rather that in the filterchain - I don't like to see calls to write and exit buried deep within the code
if(!is_null($httpResponse->getAttribute(\Gossamer\Horus\Filters\FilterChain::IMMEDIATE_WRITE))){
    renderResult(array('data' => $httpResponse->getAttribute('data')));
}
