<?php namespace sense;

use sense\Container;
use sense\net\Request;
use sense\net\Response;
use sense\net\Route;
use sense\net\RouteCollection;
use sense\net\Router;

class Sense
{
    public $instance;
    
    public function __construct()
    {

        $this->loadDependencies();
        
//         $this->loadRouting();
    }
    
    public function loadDependencies()
    {
        Container::instance();
        
        new Request;
        new Response;
    }
    
    public function loadRouting()
    {
        require_once dirname(__FILE__) . "/../app/routes.php";
        
        RouteCollection::toPux();
    }

    public function run()
    {        
        return true;
    }
    
    /**
     * @return \sense\net\Request
     */
    public static function getRequest()
    {
        return Container::get('request');
    }
    
    /**
     * @return \sense\net\Response
     */
    public static function getResponse()
    {
        return Container::get('response');
    }
}

function sense()
{
    
}