<?php

include "vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// register templating
Twig_Autoloader::register();
    
$loader = new Twig_Loader_Filesystem(realpath('./app/views'));
$twig = new Twig_Environment($loader, array(
    'cache' => realpath('./app/storage/cache'),
));

echo $twig->render('index.twig', array('the' => 'variables', 'go' => 'here')); die;



error_reporting(-1);

use Monolog\Logger;
use Monolog\Handler\SlackHandler;


$log = new Logger('sense');
$log->pushHandler(new SlackHandler('xoxp-9930138018-9930138050-9952454677-c51459', 'C09TBMF96', 'Monolog', true, null, Logger::DEBUG));


$config = include 'app/config.php';

$container = \sense\Container::getInstance();


return $sense = (new \sense\Sense($container))
    ->injectLoader($log)
    ->loadDependencies()
    ->loadRouting()
    ->run();