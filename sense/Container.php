<?php namespace sense;

class Container extends \Pimple\Container
{
    use SingletonInstance;
    
    public static function get($id)
    {
        return self::$instance->offsetGet($id);
    }

    public static function set($key, $value)
    {
        return self::$instance->offsetSet($key, $value);
    }

    public static function exists($key)
    {
        return self::$instance->offsetExists($key);
    }

    public static function remove($key)
    {
        return self::$instance->offsetUnset($key);
    }
}