<?php namespace wash;

class HTTP 
{
    const OK = 200;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const ERROR = 500;
}

class Param 
{
    const Method = '@method';
    const Route = '@route';
    const Service = '@service';
    const Guard = '@guard';
}