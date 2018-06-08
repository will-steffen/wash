<?php namespace wash;

class HTTP 
{
    const OK = 200;
    const ERROR = 500;
    const NOT_FOUND = 404;
    const FORBIDDEN = 403;
}

class Param 
{
    const Method = '@method';
    const Route = '@route';
    const Service = '@service';
    const Guard = '@guard';
}