<?php

use wash\HTTP as HTTP;

/** @route="methods" */
class MethodsController extends wash\Controller
{
    /** @route="" */
    public function defaultGet () 
    {
        return $this->string("default GET", HTTP::OK);
    }

    /** @route="" @method="post" */
    public function defaultPost () 
    {
        return $this->string("default POST", HTTP::OK);
    }

    /** @route="" @method="put" */
    public function defaultPut () 
    {
        return $this->string("default PUT", HTTP::OK);
    }

    /** @route="" @method="custom" */
    public function defaultCustom () 
    {
        return $this->string("default CUSTOM", HTTP::OK);
    }

    

    /** @route="defined" */
    public function definedGet () 
    {
        return $this->string("defined GET", HTTP::OK);
    }

    /** @route="defined" @method="post" */
    public function definedPost () 
    {
        return $this->string("defined POST", HTTP::OK);
    }

    /** @route="defined" @method="put" */
    public function definedPut () 
    {
        return $this->string("defined PUT", HTTP::OK);
    }

    /** @route="defined" @method="custom" */
    public function definedCustom () 
    {
        return $this->string("defined CUSTOM", HTTP::OK);
    }



    /** @route="param/{param}" @method="get" */
    public function paramGet ($param) 
    {
        return $this->string("param GET " + $param, HTTP::OK);
    }

    /** @route="param" @method="post" */
    public function paramPost ($param) 
    {
        return $this->string("param POST " + $param, HTTP::OK);
    }

    /** @route="param" @method="put" */
    public function paramPut ($param) 
    {
        return $this->string("param PUT " + $param, HTTP::OK);
    }

    /** @route="param" @method="custom" */
    public function paramCustom ($param) 
    {
        return $this->string("param CUSTOM " + $param, HTTP::OK);
    }

}