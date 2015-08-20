<?php namespace Sense\Tests;

require "../vendor/autoload.php";

class SenseTest extends \PHPUnit_Framework_TestCase
{
    public $instance;
    
    public function setUp()
    {
        $this->instance = new \sense\Sense();
    }
    
    public function runTest()
    {
        $this->assertTrue($this->instance->run());
    }
}
