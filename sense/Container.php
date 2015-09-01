<?php namespace sense;

class Container
{
    private static $_instance = null;
    
    private $_data = array();
    
    private function __construct() {}
    
    public function getInstance()
    {
        return is_null(self::$_instance) ? (self::$_instance = new self) : self::$_instance;
    }
    
    public function __get($name)
    {
        $instance = self::getInstance();
        
        if ( isset($instance->_data[$name]) )
        {
            return $instance->_data[$name];
        }
        
        return null;
    }
    
    public function set($name, $value)
    {
        return self::getInstance()->_data[$name] = $value;
    }
}