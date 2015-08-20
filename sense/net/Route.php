<?php namespace sense\net;
use sense\Sense;

/**
 * Class Route
 * @package sense\net
 *
 * @method static Route get($path, $action)
 * @method static Route post($path, $action)
 */
class Route
{
    public $path = null;

    public $action = array();

    public $requires = array();

    public $defaults = array();

    public $verb = null;

    public static function __callStatic($method, $params)
    {
        $self = new self;

        $self->path = $params[0];
        $self->verb = strtolower($method);
        
        list($self->action['controller'], $self->action['method']) = explode('@', $params[1]);

        RouteCollection::add($self);

        return $self;
    }

    public function requires ($params)
    {
        $this->requires = $params;

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

    public static function compile()
    {
        $router = Sense::getRouter();

        if ( count(self::$routes) )
        {
            foreach ( self::$routes as $route )
            {
                $router->{$route->verb}($route->path, [ $route->action['controller'], $route->action['method'] ],
                    [
                        'require' => $route->requires,
                        'default' => $route->defaults
                    ]
                );
            }
        }
    }
}