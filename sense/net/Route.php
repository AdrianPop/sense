<?php namespace sense\net;

class Route
{
    public static function get($path, $action)
    {
        $self = new self;

        $self->path = $path;
        
        list($self->action['controller'], $self->action['method']) = explode('@', $action);

        RouteCollection::add($self);

        return $self;
    }

    public function where ($params)
    {
        $this->where = $params;

        return $this;
    }

    public function defaults ($params)
    {
        $this->defaults = $params;

        return $this;
    }
}

class RouteCollection
{
    /**
     * @var \SplObjectStorage
     */
    public static $routes;

    public static function add(Route $route)
    {
        if ( ! (self::$routes instanceof \SplObjectStorage) )
        {
            self::$routes = new \SplObjectStorage();
        }

        if ( ! self::$routes->offsetExists($route) )
        {
            self::$routes->attach($route);

            return;
        }
    }

    public static function toPux()
    {
        foreach ( self::$routes as $route )
        {
            print_r($route);
        }
    }
}