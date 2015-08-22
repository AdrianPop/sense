<?php namespace sense\net;

use \Pux\Mux as PuxMux;
use \Pux\Executor;
use sense\Sense;
use sense\net\Route;
use sense\C;

class Router extends PuxMux
{
    
    public function create(Route $route)
    {
        foreach ( $route->method as $method )
        {
            $this->{$method}($route->uriPath, [ $route->callable[0], $route->callable[1] ],
                [
                    'require' => $route->requires,
                    'default' => $route->defaults
                ]
            );
        }
    }
    
    public function dispatchAndRespond()
    {
        $response = C::get('response');
        
        $route = $this->dispatch($_SERVER['REQUEST_URI']);
        
        if (is_null($route))
        {
            $response->setStatusCode(Response::STATUS_CODE_404)
                ->setContent('404 Not Found');
        }
        else
        {
            $response->setContent(\Pux\Executor::execute($route));
        }
        
        return $response->send();
    }
}