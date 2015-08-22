<?php

use sense\net\Route;

$routes = array();

$routes[] = new Route('get,post', '/:id', 'IndexController@index', ['id'   => '\d+'], ['id'   => 999]);


return $routes;