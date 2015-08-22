<?php namespace sense;

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
 *
 * @method static Request getRequest()
 * @method static Response getResponse()
 * @method static Router getRouter()
 */
class Sense
{
    public $instance;

    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;

        $this->loadDependencies();
        $this->loadRouting();
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
    }

    /**
     * Load routes and compile them to Pux
     *
     * @return $this
     */
    public function loadRouting()
    {
        include_once dirname(__FILE__) . "/../app/routes.php";
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