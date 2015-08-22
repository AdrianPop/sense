<?php

use sense\C;
use sense\net\Route;

/**
 * @var \sense\Router
 */
$router = C::get('router');

$router->create(new Route('get,post', '/:id', 'IndexController@index', ['id'   => '\d+'], ['id'   => 999]));
