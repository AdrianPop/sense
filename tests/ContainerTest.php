<?php namespace tests;

use sense\C;

error_reporting(-1); ini_set('display_errors', 1);

require dirname(__FILE__) . "/../vendor/autoload.php";

class CTest extends \PHPUnit_Framework_TestCase
{
    /*
     * @var \sense\Container
     */
    public $instance;

    public $key = 'test';
    public $val = 123;

    public function setUp()
    {
        C::forceGenerateInstance();
    }
    
    public function testFlow()
    {
        C::set($this->key, $this->val);
        
        $this->assertTrue(C::exists($this->key));
        $this->assertFalse(C::exists($this->key . "1"));
        $this->assertEquals($this->val, C::get($this->key));
        
        C::remove($this->key, $this->val);
        
        $this->assertFalse(C::exists($this->key));
    }
}
