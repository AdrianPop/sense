<?php namespace tests;


use sense\Container;
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
        new \sense\Sense();

        $this->router = Sense::getRouter();

        Route::get('/1', 'IndexController@index');

        RouteCollection::compile();
    }

    public function testMatchingRoute()
    {
        $_SERVER['REQUEST_METHOD'] = "GET";

        $this->assertNotNull($this->router->dispatch('/1'));
    }

    public function testNonMatchingRoute()
    {
        $_SERVER['REQUEST_METHOD'] = "GET";

        $this->assertNull($this->router->dispatch('/123'));
    }

    public function testNonMatchingPostOnGetRoute()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";

        $this->assertNull($this->router->dispatch('/1'));
    }
}