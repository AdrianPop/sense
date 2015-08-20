<?php namespace sense\net;

use \Zend\Http\PhpEnvironment\Request as HttpRequest;

class Request extends HttpRequest
{
    public function __construct()
    {
        \sense\Container::set('request', $this);
        
        return parent::__construct();
    }
}