<?php

include "vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


use Monolog\Logger;
use Monolog\Handler\SlackHandler;
use Monolog\Formatter\LogglyFormatter;


$log = new Logger('sense');
$log->pushHandler(new SlackHandler('xoxp-9930138018-9930138050-9952454677-c51459', 'C09TBMF96', 'Monolog', true, null, Logger::DEBUG));


$config = include 'app/config.php';

$container = \sense\Container::getInstance();



return $sense = (new \sense\Sense($container))
    ->injectLoader($log)
    ->loadDependencies()
    ->loadRouting()
    ->run();