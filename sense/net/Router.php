<?php namespace sense\net;

use \Pux\Mux as PuxMux;

class Router extends PuxMux
{
    public function __construct()
    {
        \sense\Container::set('router', $this);
    }
}