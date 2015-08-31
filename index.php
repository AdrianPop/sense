<?php

include "vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


use Monolog\Logger;
use Monolog\Handler\SlackHandler;
use Monolog\Formatter\LogglyFormatter;

$log = new Logger('appName');
$log->pushHandler(new SlackHandler('xoxp-9930138018-9930138050-9952454677-c51459', 'C09TBMF96', 'Monolog', true, null, Logger::DEBUG));


function loadClass($class)
{
    static $__loaded;

    if ( isset($__loaded[$class]) )
    {
        return $__loaded[$class];
    }

    $instance = new $class;
    return $__loaded[get_class($instance)] = $instance;
}



$config = include 'app/config.php';

$container = new \sense\Container();

return $sense = (new \sense\Sense($container))
    ->loadLogger($log)
    ->loadDependencies()
    ->loadRouting()
    ->run();