<?php

use Gossamer\Core\Exceptions\FileNotFoundException;

function loadConfig($configPath = null, $ymlKey = null, $type = null, $keys = null) {

    $loader = new \Gossamer\Essentials\Configuration\YamlLoader();

    $loader->setFilePath($configPath);
    $config = $loader->loadConfig();

    if (!is_null($keys)) {
        if (is_null($config)) {
            throw new FileNotFoundException($configPath . ' does not exist');
        }

        if (array_key_exists($ymlKey, $config)) {
            $config = $config[$ymlKey][$type];
            //check to see if it's just an empty file
            if (!is_array($config) || count($config) == 0) {
                return array();
            }
            foreach ($config as $index => $row) {
                if ($row['event'] != $keys) {
                    unset($config[$index]);
                }
            }

        } else {
            //nothing found for this yml key
            return array();
        }
    } elseif (!is_null($ymlKey)) {
        if (array_key_exists($ymlKey, $config)) {
            return $config[$ymlKey];
        }
    }

    return $config;
}

function pr($item) {
    echo '<pre>';
    var_dump($item);
    echo '</pre>';
}

function dd($item) {
    pr($item);
    die;
}

function buildLogger(\Gossamer\Essentials\Configuration\SiteParams $params) {

    $config = loadConfig($params->getConfigPath() . 'config.yml');

    $loggerConfig = $config['logger'];
    $loggerClass = $loggerConfig['class'];
    $logger = new $loggerClass('rest-service');
    $handlerClass = $loggerConfig['handler']['class'];
    $logLevel = $loggerConfig['handler']['loglevel'];
    $logFile = $loggerConfig['handler']['logfile'];

    $maxFiles = null;
    if (array_key_exists('maxfiles', $loggerConfig['handler'])) {
        $maxFiles = $loggerConfig['handler']['maxfiles'];
    }
    if (is_null($maxFiles)) {
        $logger->pushHandler(new $handlerClass($params->getLogPath() . $logFile, $logLevel));
    } else {
        $logger->pushHandler(new $handlerClass($params->getLogPath() . $logFile, $maxFiles, $logLevel));
    }

    return $logger;
}

function class_uses_deep($class, $autoload = true)
{
    $traits = [];

    // Get traits of all parent classes
    do {
        $traits = array_merge(class_uses($class, $autoload), $traits);
    } while ($class = get_parent_class($class));

    // Get traits of all parent traits
    $traitsToSearch = $traits;
    while (!empty($traitsToSearch)) {
        $newTraits = class_uses(array_pop($traitsToSearch), $autoload);
        $traits = array_merge($newTraits, $traits);
        $traitsToSearch = array_merge($newTraits, $traitsToSearch);
    };

    foreach ($traits as $trait => $same) {
        $traits = array_merge(class_uses($trait, $autoload), $traits);
    }

    return array_unique($traits);
}

function renderResult(\Gossamer\Core\Http\Responses\AbstractResponse $response,
    \Gossamer\Horus\Http\HttpRequest $httpRequest,
    \Gossamer\Horus\Http\HttpResponse $httpResponse) {

    runFilters($httpRequest->getSiteParams()->getConfigPath() . 'filters.yml', 'all',\Gossamer\Horus\Filters\FilterEvents::FILTER_EXIT_POINT);

    foreach ($response->getHeaders() as $header) {
        header($header);
    }
    foreach ($httpResponse->getHeaders() as $header) {
        header($header);
    }
    foreach($response->getCookies() as $key => $cookie) {
        setcookie($key, $cookie);
    }
    foreach ($httpResponse->getCookies() as $key => $cookie) {
        setcookie($key, $cookie);
    }

    if (is_null($response->getBody())) {
        die('no response generated');
    }
    print_r($response->getBody());
    exit;
}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = //chr(123)// "{"
            substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
            //.chr(125);// "}"
        return $uuid;
    }
}


function runFilters(string $filterConfigPath, string $ymlKey, string $eventName) {

    global $httpRequest;
    global $httpResponse;
    global $eventDispatcher;
    global $filterService;
    try {

        $config = loadConfig($filterConfigPath, $ymlKey, 'filters', $eventName);

        if(is_null($config)) {
            //nothing to do
            return;
        }
        $filterService->setFilters($config);

        $result = $filterService->filterRequest($httpRequest, $httpResponse, $eventName);

        if (is_array($result)) {
            renderResult($result);
        }

    } catch (FileNotFoundException $e) {
        //nothing needed to run
    } catch (\Exception $e) {
        echo $e->getMessage();
        die;
        $params = array('code' => $e->getCode(), 'message' => $e->getMessage());
        $event = new \Gossamer\Horus\EventListeners\Event(\Gossamer\Core\System\KernelEvents::ERROR_OCCURRED, $params);
        $eventDispatcher->dispatch('all', \Gossamer\Core\System\KernelEvents::ERROR_OCCURRED, $event);

//    $view = new \core\views\HtmlErrorView($siteParams->getSitePath() . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'themes' .
//    DIRECTORY_SEPARATOR . 'errors' . DIRECTORY_SEPARATOR . $e->getCode() . '.htm');
//    $view->render();
//    die;

    }

}
