<?php namespace tests;

use sense\Container;

require dirname(__FILE__) . "/../vendor/autoload.php";

class SenseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \sense\Sense
     */
    public $instance;

    public function setUp()
    {
        $this->instance = new \sense\Sense(new Container());
    }

    public function testRun()
    {
        return true;
    }
}
