<?php namespace sense;

use Monolog\Logger;
use Pux\Executor;
use sense\C;
use sense\net\Request;
use sense\net\Response;
use sense\net\Route;
use sense\net\RouteCollection;
use sense\net\Router;


/**
 * Class Sense
 * @package sense
 */
class Sense
{
    public $instance;

    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Load require dependencies
     *
     * @return $this
     */
    public function loadDependencies()
    {
        $this->container->offsetSet('request', new Request());
        $this->container->offsetSet('response', new Response());
        $this->container->offsetSet('router', new Router($this->container));

        return $this;
    }

    /**
     * Load routes and compile them to Pux
     *
     * @return $this
     */
    public function loadRouting()
    {
        $routes = require_once dirname(__FILE__) . "/../app/routes.php";

        $this->getContainer()
            ->offsetGet('router')
            ->attachRoutes($routes);

        return $this;
    }

    public function loadLogger(Logger $logger)
    {
        $this->container->offsetSet('logger', $logger);

        return $this;
    }

    /**
     * Run
     * @return bool
     */
    public function run()
    {
        return $this->container->offsetGet('router')->dispatchAndRespond();
    }
}