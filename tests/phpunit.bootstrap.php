<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);
@session_start();
date_default_timezone_set('America/Vancouver');

$sitePath = realpath(dirname(__FILE__)); // strip the /web from it
$sitePath = str_replace('/tests', '', $sitePath);

define('__SITE_PATH', $sitePath);
define('__CACHE_DIRECTORY', $sitePath . '/app/cache');
define('__DEBUG_OUTPUT_PATH', $sitePath . '/../logs/phpunit.log');
define('__CONFIG_PATH', $sitePath . '/app/config/');
define('__PHPUNIT_FILE_PATH', $sitePath . '/tests/_output/');

//include_once('phpunit.configuration.php');
require_once(__SITE_PATH . '/vendor/composer/ClassLoader.php');
require_once(__SITE_PATH . '/vendor/autoload.php');
//require_once 'phpunit.systemfunctions.php';
$loader = new Composer\Autoload\ClassLoader();

// register classes with namespaces
$loader->add('Components', $sitePath . '/src');
$loader->add('Gossamer', $sitePath . '/lib');
$loader->add('Extensions', $sitePath . '/src');
$loader->add('tests', $sitePath . '/tests');
$loader->add('Monolog', __SITE_PATH . '/vendor/monolog/monolog/src');
$loader->add('Auth0\SDK', __SITE_PATH . '/vendor/auth0/auth0-php/src/');
$loader->add('PHPUnit\Framework', __SITE_PATH . '/vendor/phpunit/phpunit/src');
$loader->add('Eloquent', __SITE_PATH . '/vendor/phpunit/phpunit/src');
// activate the autoloader
$loader->register();

// to enable searching the include path (eg. for PEAR packages)
$loader->setUseIncludePath(true);

$siteParams = new \Gossamer\Essentials\Configuration\SiteParams();
$siteParams->setSitePath($sitePath);
$siteParams->setConfigPath($sitePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);
$siteParams->setLogPath($sitePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR);
$siteParams->setSiteName('PHP_UNIT_SERVER');
$siteParams->setCacheDirectory($sitePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR);
$siteParams->setDebugOutputPath('/var/www/binghan/logs/rest4_debug.log');
$siteParams->setIsCaching(true);
$siteParams->setSiteConfig(loadConfig($siteParams->getConfigPath() . 'config.yml'));


$capsule = new Illuminate\Database\Capsule\Manager();

$capsule->addConnection([
    "driver" => "mysql",
    'host' => 'localhost',
    'username' => 'goss3_user',
    'password' => 'dh7djsdk4',
    'database' => 'gossamer3_phpunit'
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$databaseSeeder = new \tests\Database\DatabaseSeeder();
$databaseSeeder->execute();

function loadConfig($configPath, $ymlKey = null, $type = null, $keys = null) {
    $loader = new \Gossamer\Essentials\Configuration\YamlLoader();

    $loader->setFilePath($configPath);
    $config = $loader->loadConfig();

    if (!is_null($keys)) {
        if (is_null($config)) {
            throw new \Gossamer\Essentials\Configuration\Exceptions\FileNotFoundException($configPath . ' does not exist');
        }

        if (array_key_exists($ymlKey, $config)) {
            $config = $config[$ymlKey][$type];
            //check to see if it's just an empty file
            if(!is_array($config) || count($config) == 0) {
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
    }elseif(!is_null($ymlKey)) {
        if(array_key_exists($ymlKey, $config)) {
            return $config[$ymlKey];
        }
    }

    return $config;
}



function super_unset($item) {
    try {
        if (is_object($item) && method_exists($item, "__destruct")) {
            $item->__destruct();
        }
    } catch (\Exception $e) {

    }
    //unset($item);
    $item = null;
}

$_SESSION = array();

function getSession($key) {
    global $_SESSION;
    $session = $_SESSION;


    return fixObject($session[$key]);
}

function setSession($key, $value) {
    global $_SESSION;
    $_SESSION[$key] = $value;

}

function fixObject(&$object) {
    if (!is_object($object) && gettype($object) == 'object') {

        return ($object = unserialize(serialize($object)));
    }

    return $object;
}



function buildLogger() {
    global $siteParams;

    $config = loadConfig($siteParams->getConfigPath() . 'config.yml');

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
        $logger->pushHandler(new $handlerClass($siteParams->getLogPath() . $logFile, $logLevel));
    } else {
        $logger->pushHandler(new $handlerClass($siteParams->getLogPath() . $logFile, $maxFiles, $logLevel));
    }

    return $logger;
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


function pr($message) {
    echo "\r\n....print...\r\n";
    print_r($message);
    echo "\r\n...end print...\r\n";
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
