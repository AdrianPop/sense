<?php namespace tests;

use sense\net\Response;

error_reporting(-1); ini_set('display_errors', 1);
require dirname(__FILE__) . "/../../vendor/autoload.php";

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public $instance;

    public function setUp()
    {
        $this->instance = new Response();
    }

    public function test__construct()
    {
        $this->assertInstanceOf('sense\net\Response', $this->instance);
    }
}