<?php namespace sense\net;

use \Pux\Mux as PuxMux;
use sense\Container;

class Router extends PuxMux
{
    /**
     * @var Container
     */
    private $container = null;

    public function __construct($container)
    {
        $this->container = $container;
    }

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

    /**
     * Should be moved to Response
     *
     * @return mixed
     * @throws \Exception
     */
    public function dispatchAndRespond()
    {
        $response = $this->container->offsetGet('response');

        /**
         * @var Request
         */
        $request = $this->container->offsetGet('request');
        
        $route = $this->dispatch($request->getRequestUri());
        
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