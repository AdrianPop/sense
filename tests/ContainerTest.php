<?php namespace tests;

use sense\Container;

require dirname(__FILE__) . "/../vendor/autoload.php";

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /*
     * @var \sense\Container
     */
    public $instance;

    public function setUp()
    {
        $this->instance = Container::getInstance();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('sense\Container', $this->instance);
    }
}
