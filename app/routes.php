<?php

use sense\net\Route;

/**
 * path, controller @ action, require, defaults
 */
Route::get('/0/:id', 'IndexController@index')
    ->requires(['id'   => '\d+'])
    ->defaults(['id' => 999]);

Route::get('/1', 'IndexController@index');