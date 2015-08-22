<?php namespace sense\net;

class Route
{
    public $method;
    
    public $uriPath;
    
    public $callable;
    
    public $requires;
    
    public $defaults;
    
    public function __construct($method, $uriPath, $callable, $requires = [], $defaults = [])
    {
        $this->method = explode(',', $method);
        
        $this->uriPath = $uriPath;
        
        $this->callable = is_object($callable) ? $callable : explode('@', $callable);
        
        $this->requires = $requires;
        
        $this->defaults = $defaults;
    }
}