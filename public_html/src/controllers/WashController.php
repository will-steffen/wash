<?php

use wash\Controller as Controller;
use wash\HTTP as HTTP;

/**
 * @route="wash"
 */
class WashController extends Controller
{

    /** @service="WashService" */
    public $washService;

    /**
     * @route=""
     */
    public function get () 
    {
        return $this->string("WashController", HTTP::OK);
    }

    /**
     * @route="some"
     */
    public function getSome () 
    {
        return $this->string($this->washService->getSomething(), HTTP::OK);
    }

    /**
     * @route="with-arg/{arg}"
     */
    public function getWithArg ($arg) 
    {
        return $this->string("You sent $arg", HTTP::OK);
    }

}