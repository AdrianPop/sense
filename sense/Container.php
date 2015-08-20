<?php namespace sense;



class Container extends \Pimple\Container
{
    use \sense\SingletonInstance;
    
    public static function get($id)
    {
        return self::$instance->offsetGet($id);
    }
    
    public static function set($key, $value)
    {
        return self::$instance->offsetSet($key, $value);
    }
}