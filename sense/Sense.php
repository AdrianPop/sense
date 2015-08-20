<?php namespace sense;

use sense\Container;
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

    public static function __callStatic($method, $params = array())
    {
        if ( substr($method, 0, 3) == "get" )
        {
            return Container::get(strtolower(substr($method, 3)));
        }
    }

    public function __construct()
    {

        $this->loadDependencies()
            ->loadRouting();
    }

    /**
     * Load require dependencies
     *
     * @return $this
     */
    public function loadDependencies()
    {
        Container::instance();
        
        new Request;
        new Response;
        new Router;

        return $this;
    }

    /**
     * Load routes and compile them to Pux
     *
     * @return $this
     */
    public function loadRouting()
    {
        include_once dirname(__FILE__) . "/../app/routes.php";
        
        RouteCollection::compile();

        return $this;
    }

    /**
     * Run
     * @return bool
     */
    public function run()
    {        
        return true;
    }
    
//    /**
//     * Get Request object
//     *
//     * @return \sense\net\Request
//     */
//    public static function getRequest()
//    {
//        return Container::get('request');
//    }
//
//    /**
//     * Get Response object
//     *
//     * @return \sense\net\Response
//     */
//    public static function getResponse()
//    {
//        return Container::get('response');
//    }
//
//    /**
//     * Get Router object
//     *
//     * @return \sense\net\Response
//     */
//    public static function getRouter()
//    {
//        return Container::get('router');
//    }
}