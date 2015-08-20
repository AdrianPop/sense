<?php namespace sense\core;

use Pimple\Container;
use Pux\Mux;

class Loader extends Container
{

}

function loader($key)
{
    static $loader;

    if ( ! isset($loader) )
    {
        $loader = new Loader();
    }

    return $loader->offsetGet('key');
}