<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//out this here so we can have debug output and still write custom headers
ob_start();

//phpinfo();
//die('done');


ini_set('default_charset', 'UTF-8');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type,Accept, JWT, Authorization, enctype, Pragma, Cache-Control');//enctype, Pragma, Cache-Control = file upload
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS, HEAD");
header('Access-Control-Allow-Credentials: true');

if(array_key_exists('HTTP_ORIGIN', $_SERVER) &&
($_SERVER['HTTP_ORIGIN'] == 'http://localhost:4200' ||
$_SERVER['HTTP_ORIGIN'] == 'http://localhost:8100' ||
$_SERVER['HTTP_ORIGIN'] == 'http://localhost:8002' ||
$_SERVER['HTTP_ORIGIN'] == 'http://localhost:8080' ||
$_SERVER['HTTP_ORIGIN'] == 'http://localhost:8000' ||
$_SERVER['HTTP_ORIGIN'] == 'http://70.68.149.100')) { //my computer
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
}
if ($_SERVER['REQUEST_METHOD']=='OPTIONS') {
header("HTTP/1.1 200 OK");
die();
}
//print_r($_REQUEST);
//these are included in order of operation - do not change!
include_once('../app/includes/functions.php');
include_once('../app/includes/configuration.php');
include_once('../vendor/autoload.php');
include_once('../app/includes/init.php');
include_once('../app/includes/bootstrap.php');

$kernel = new \Gossamer\Core\System\Kernel($httpRequest, $httpResponse, $container, $eventDispatcher);
$response = $kernel->run($nodeConfig);

renderResult($response, $httpRequest, $httpResponse);
