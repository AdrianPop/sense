<?php namespace sense;

use \Pimple\Container as PimpleContainer;   

class Container extends PimpleContainer
{
//    private static $_instance = null;
//
//    private static function checkOrGenerateInstance()
//    {
//        if (is_null(self::$_instance))
//        {
//            self::$_instance = new PimpleContainer;
//        }
//    }
//
//    public static function forceGenerateInstance()
//    {
//        self::$_instance = new PimpleContainer;
//    }
//
//    public static function set($key, $value)
//    {
//        self::checkOrGenerateInstance();
//
//        self::$_instance->offsetSet($key, $value);
//    }
//
//    public static function exists($key)
//    {
//        self::checkOrGenerateInstance();
//
//        return self::$_instance->offsetExists($key);
//    }
//
//    public static function get($key)
//    {
//        self::checkOrGenerateInstance();
//
//        if ( self::$_instance->offsetExists($key) )
//        {
//            return self::$_instance->offsetGet($key);
//        }
//
//        return null;
//    }
//
//    public static function remove($key)
//    {
//        self::checkOrGenerateInstance();
//
//        if ( self::$_instance->offsetExists($key) )
//        {
//            return self::$_instance->offsetUnset($key);
//        }
//
//        return null;
//    }
}