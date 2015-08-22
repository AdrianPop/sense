<?php

include "vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


error_reporting(E_ALL);
ini_set("display_errors", 1);

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
    ->loadDependencies()
    ->loadRouting()
    ->run();