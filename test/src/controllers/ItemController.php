<?php

use wash\Controller as WashController;
use wash\HTTP as HTTP;

/**
 * @route="item"
 */
class ItemController extends WashController
{

    /**
     * @route="get"
     */
    public function get () 
    {
        return $this->json("get from ItemController", HTTP::OK);
    }

}