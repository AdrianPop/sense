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

    public function attachRoutes($routes)
    {
        foreach ( $routes as $route )
        {
            $this->create($route);
        }
    }

    private function create(Route $route)
    {
        foreach ( $route->method as $method )
        {
            $this->{$method}($route->uriPath, $route->callable,
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
        $response = $this->container->response;

        $request = $this->container->request;

        $route = $this->dispatch($request->getRequestUri());

        if (is_null($route))
        {
            $response->setStatusCode(Response::STATUS_CODE_404)
                ->setContent('404 Not Found!');

            return $response->send();
        }

        $response->setContent(\Pux\Executor::execute($route));
        return $response->send();
    }
}