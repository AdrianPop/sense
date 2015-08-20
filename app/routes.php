<?php

use sense\net\Route;

/**
 * path, controller @ action, require, defaults
 */
Route::get('/0', 'IndexController@index')
    ->requires(['id'   => '\d+'])
    ->defaults(['id' => 999]);

Route::get('/1', 'IndexController@index');

Route::get('/2', 'IndexController@index');
Route::post('/post', 'IndexController@index');