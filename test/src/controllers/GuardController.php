<?php

use wash\HTTP as HTTP;

/** @route="guard" @guard="GuardService" */
class GuardController extends wash\Controller
{
    /** @route="open-get" */
    public function openGet () 
    {
        return $this->string("open GET on guard", HTTP::OK);
    }

    /** @route="close-get" @guard="notPass" */
    public function closeGet () 
    {
        return $this->string("close GET on guard", HTTP::OK);
    }

}
