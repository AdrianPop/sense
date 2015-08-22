<?php namespace tests;


use sense\C;
use sense\net\Route;
use sense\net\RouteCollection;
use sense\net\Router;
use sense\Sense;

error_reporting(-1); ini_set('display_errors', 1);
require dirname(__FILE__) . "/../../vendor/autoload.php";

/**
 * Actually test the routing system as a whole...
 *
 * Class RouterTest
 * @package tests
 */
class RoutingTest extends \PHPUnit_Framework_TestCase
{
    public $router;

    public function setUp()
    {
        $this->router = C::get('router');
        
        $this->router->create(new Route('get', '/:id', 'IndexController@index', ['id'   => '\d+'], ['id'   => 999]));
    }

    public function testFlow()
    {
        $_SERVER['REQUEST_METHOD'] = "GET";

        // matching route
        $this->assertNotNull($this->router->dispatch('/1'));
        
        // non matching routes
        $this->assertNull($this->router->dispatch('/abc'));
        $this->assertNull($this->router->dispatch('/1/2/3'));
        
    }
}