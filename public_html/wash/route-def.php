<?php namespace wash;

class RouteDef 
{

    public $path;
    public $class;
    public $method;
    public $url;
    public $methodRoute;
    

    public function __construct ($path, $class, $method, $url, $methodRoute) 
    {
        $this->path = $path;
        $this->class = $class;
        $this->method = $method;
        $this->url = $url;
        $this->methodRoute = $methodRoute;
    }

}