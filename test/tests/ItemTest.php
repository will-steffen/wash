<?php

include_once 'WashTestCase.php';

class ItemTest extends WashTestCase
{

    public function testGet ()
    {
        $result = $this->request('GET', 'item/get');
        $expect = "get from ItemController";
        $this->assertEquals($expect, $result);
    }

}