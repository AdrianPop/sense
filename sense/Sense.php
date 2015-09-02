<?php namespace sense;

use Monolog\Logger;
use sense\C;
use sense\net\Request;
use sense\net\Response;
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
        $this->container->set('request', new Request());
        $this->container->set('response', new Response());
        $this->container->set('router', new Router($this->container));

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

        $this->getContainer()->router->attachRoutes($routes);

        return $this;
    }

    public function injectLoader(Logger $logger)
    {
        $this->container->set('logger', $logger);

        return $this;
    }

    /**
     * Run
     * @return bool
     */
    public function run()
    {
        return $this->container->router->dispatchAndRespond();
    }
}