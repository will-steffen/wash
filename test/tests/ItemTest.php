<?php

include_once 'WashTestCase.php';

class ItemTest extends WashTestCase
{

    public function testGet ()
    {
        $result = json_decode($this->request('GET', 'item/get'));
        $expect = "echo from Wash";
        $this->assertEquals($expect, $result);
    }

}