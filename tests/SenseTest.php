<?php namespace sense;

require "/home/codio/workspace/sense/vendor/autoload.php";

class SenseTest extends \PHPUnit_Framework_TestCase
{
    public $instance;
    
    public function setUp()
    {
        $this->instance = new \sense\Sense();
    }
    
    /**
     * @test
     */
    public function runTest()
    {
        $this->assertTrue(true);
    }
}
