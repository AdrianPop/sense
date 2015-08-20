<?php namespace tests;

use sense\Container;

error_reporting(-1); ini_set('display_errors', 1);

require dirname(__FILE__) . "/../vendor/autoload.php";

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /*
     * @var \sense\Container
     */
    public $instance;

    public $key = 'test';
    public $val = 123;

    public function setUp()
    {
        $this->instance = Container::instance();

        $this->instance->set($this->key, $this->val);
    }

    public function testGet()
    {
        $this->assertInstanceOf('\sense\Container', $this->instance);

        $this->assertEquals($this->val, $this->instance->get($this->key));
    }

    public function testSet()
    {
        $this->assertTrue($this->instance->exists($this->key));
    }

    public function testExists()
    {
        $this->assertTrue($this->instance->exists($this->key));
    }

    public function testRemove()
    {
        $this->instance->remove($this->key);

        $this->assertFalse($this->instance->exists($this->key));
    }
}
