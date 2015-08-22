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

    public function __construct()
    {

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
        C::forceGenerateInstance();
        
        C::set('request', new Request);
        C::set('response', new Response);
        C::set('router', new Router);
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
        return C::get('router')->dispatchAndRespond();
    }
}