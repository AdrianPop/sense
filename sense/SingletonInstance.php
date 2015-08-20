<?php namespace sense;

trait SingletonInstance
{
    public static $instance = null;
    
    public static function instance()
    {                
        return is_null(self::$instance) ? (self::$instance = new static) : self::$instance;
    }
}