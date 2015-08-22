<?php

include "vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


error_reporting(E_ALL);
ini_set("display_errors", 1);

use Zend\Http\PhpEnvironment;

$config = include 'app/config.php';

$container = new \sense\Container();

return $sense = (new \sense\Sense($container))->run();