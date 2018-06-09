<?php

use wash\Controller as WashController;
use wash\HTTP as HTTP;

/** @route="simple" */
class SimpleController extends WashController
{

    /** @route="" */
    public function get () 
    {
        return $this->string("SimpleController default GET", HTTP::OK);
    }

    /** @route="error" */
    public function getError () 
    {
        return $this->string("SimpleController error GET", HTTP::ERROR);
    }

}