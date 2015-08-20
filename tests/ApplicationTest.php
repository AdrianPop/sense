<?php namespace Sense\Tests;

require "../vendor/autoload.php";

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    /*
     * @var \Zappy\Application
     */
    public $instance;

    protected function setUp()
    {
        $this->instance = new \sense\Sense();
    }

    public function testRun()
    {
        $this->assertTrue($this->instance->run());
    }

    public function testGoodRoute()
    {
        $this->instance->router->add('home', '/');
        $this->assertInstanceOf('Aura\Router\Route', $this->instance->router->match('/', $_SERVER));
    }

    public function testBadRoute()
    {
        $this->instance->router->add('home', '/');
        $this->assertFalse($this->instance->router->match('/1', $_SERVER));
    }
}
