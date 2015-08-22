<?php namespace tests;

use sense\net\Request;

require dirname(__FILE__) . "/../../vendor/autoload.php";

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public $instance;

    public function setUp()
    {
        $this->instance = new Request();
    }

    public function test__construct()
    {
        $this->assertInstanceOf('sense\net\Request', $this->instance);
    }
}