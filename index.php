<?php

define('_CONFIG_DIR', realpath(dirname(__FILE__) . '/app/config'));



include "vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\SlackHandler;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

error_reporting(-1);

// initialize global container
$container = \sense\Container::getInstance();

// read the entire config directory and store it in the container
$config = new sense\Config(_CONFIG_DIR, $container);

// initiate slack logger
$log = new Logger('sense');
$log->pushHandler(new SlackHandler(\sense\Config::get('app.slack.token'), \sense\Config::get('app.slack.channel'), 'Monolog', true, null, Logger::DEBUG));



// GO...
return $sense = (new \sense\Sense($container))
    ->injectLoader($log)
    ->loadDependencies()
    ->loadRouting()
    ->run();