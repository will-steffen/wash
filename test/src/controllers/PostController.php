<?php

use wash\HTTP as HTTP;

/** @route="post" */
class PostController extends wash\Controller
{

    /** @route="" @method="post" */
    public function default () 
    {
        return $this->string("default POST", HTTP::OK);
    }

    /** @route="defined" @method="post" */
    public function definedGet () 
    {
        return $this->string("defined POST", HTTP::OK);
    }

    /** @route="param" @method="post" */
    public function param ($param1) 
    {
        return $this->string("param POST $param1", HTTP::OK);
    }

    /** @route="params" @method="post" */
    public function params ($param1, $param2, $param3) 
    {
        return $this->string("params POST $param1, $param2, $param3", HTTP::OK);
    }

    /** @route="params-json" @method="post" */
    public function paramsJson ($param1, $param2) 
    {
        $arr = array(
            "message" => "params Json POST",
            "param1" => $param1,
            "param2" => $param2          
        );
        return $this->json($arr, HTTP::OK);
    }

    /** @route="with-route-param/{param1}" @method="post" */
    public function routeParam ($param1, $param2, $param3) 
    {
        return $this->string("params POST $param1, $param2, $param3", HTTP::OK);
    }

}