<?php

use wash\Controller as WashController;
use wash\HTTP as HTTP;

/**
 * @route="wash"
 */
class WashController extends WashController
{

    /**
     * @route=""
     */
    public function get () 
    {
        return $this->string("WashController", HTTP::OK);
    }

}