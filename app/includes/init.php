<?php

$loader = new \Composer\Autoload\ClassLoader();

// register classes with namespaces
$loader->add('Components', $sitePath . '/src');
$loader->add('Gossamer', $sitePath . '/lib');

$loader->add('Extensions', $sitePath . '/src');
$loader->add('usercommands', $sitePath . '/src');
$loader->add('userentities', $sitePath . '/src');
$loader->add('controllers', $sitePath . '/app');
$loader->add('core', $sitePath . '/app');
$loader->add('database', $sitePath . '/app');
$loader->add('entities', $sitePath . '/app');
$loader->add('Exceptions', $sitePath . '/app');
$loader->add('filters', $sitePath . '/app');
$loader->add('libraries', $sitePath . '/app');
$loader->add('security', $sitePath . '/app');
$loader->add('plugins', $sitePath . '/plugins');

// activate the autoloader
$loader->register();

// to enable searching the include path (eg. for PEAR packages)
$loader->setUseIncludePath(true);

$siteParams = new \Gossamer\Essentials\Configuration\SiteParams();
$siteParams->setSitePath($sitePath);
$siteParams->setConfigPath($sitePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);
$siteParams->setLogPath($sitePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR);
$siteParams->setSiteName($_SERVER['SERVER_NAME']);
$siteParams->setCacheDirectory($sitePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR);
$siteParams->setDebugOutputPath('/var/www/gossamercms3/logs/rest4_debug.log');
$siteParams->setIsCaching(true);
$siteParams->setSiteConfig(loadConfig($siteParams->getConfigPath() . 'config.yml'));
