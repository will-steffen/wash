<?php

use wash\Controller as WashController;
use wash\HTTP as HTTP;

/** @route="get" */
class GetController extends WashController
{

    /** @route="" */
    public function defaultGet () 
    {
        return $this->string("default GET", HTTP::OK);
    }

    /** @route="defined" @method="get" */
    public function definedGet () 
    {
        return $this->string("defined GET", HTTP::OK);
    }

    /** @route="error" @method="get" */
    public function error () 
    {
        return $this->string("error GET", HTTP::ERROR);
    }

    /** @route="param/{param1}" */
    public function param ($param1) 
    {
        return $this->string("param GET $param1", HTTP::OK);
    }

    /** @route="params/{param1}/{param2}/{param3}" */
    public function params ($param1, $param2, $param3) 
    {
        return $this->string("params GET $param1, $param2, $param3", HTTP::OK);
    }

    /** @route="params-json/{param1}/{param2}" @method="get" */
    public function paramsJson ($param1, $param2) 
    {
        $arr = array(
            "message" => "params Json GET",
            "param1" => $param1,
            "param2" => $param2          
        );
        return $this->json($arr, HTTP::OK);
    }


}