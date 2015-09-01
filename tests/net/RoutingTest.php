<?php namespace tests;

use sense\Container;
use sense\net\Request;
use sense\net\Route;
use sense\net\Router;
use sense\Sense;

require dirname(__FILE__) . "/../../vendor/autoload.php";

/**
 * Actually test the routing system as a whole...
 *
 * Class RouterTest
 * @package tests
 */
class RoutingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Router
     */
    public $router;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var Sense
     */
    public $sense;

    public function setUp()
    {
        $sense = new Sense(Container::getInstance());
        $sense->loadDependencies();

        $this->router = $sense->getContainer()->router;
        $this->request = $sense->getContainer()->request;

        $routes = array(
            new Route('get', '/test', 'tests\TestController@test')
        );

        $this->router->attachRoutes($routes);

        $this->sense = $sense;
    }

    public function testMatchingRoute()
    {
        $this->request->setRequestUri('/test');
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $this->assertNotNull($this->router->dispatch('/test'));

        $this->router->dispatchAndRespond();
    }

    public function testFailingRoute()
    {
        $this->request->setRequestUri('/test123');
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $this->assertNull($this->router->dispatch('/test123'));

        $this->router->dispatchAndRespond();
    }

    public function testFailingRoutePOSTMethod()
    {
        $this->request->setRequestUri('/test');
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $this->assertNull($this->router->dispatch('/test'));

        $this->router->dispatchAndRespond();
    }
}

class TestController
{
    public function test()
    {
        return "test";
    }
}