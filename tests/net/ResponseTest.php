<?php namespace tests;

use sense\net\Response;

require dirname(__FILE__) . "/../../vendor/autoload.php";

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public $instance;

    public function setUp()
    {
        $this->instance = new Response();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('sense\net\Response', $this->instance);
    }
}