<?php namespace tests;

require dirname(__FILE__) . "/../vendor/autoload.php";

class SenseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \sense\Sense
     */
    public $instance;

    public function setUp()
    {
        $this->instance = new \sense\Sense();
    }

    public function testRun()
    {
        $this->assertTrue($this->instance->run());
    }
}
