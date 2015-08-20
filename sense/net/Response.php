<?php namespace sense\net;

use \Zend\Http\PhpEnvironment\Response as HttpResponse;

class Response extends HttpResponse
{
    public function __construct()
    {
        \sense\Container::set('response', $this);
    }
}