<?php

include_once 'GeneralTest.php';

class ItemTest extends GeneralTest
{

    public function testGet ()
    {
        $result = json_decode($this->request('GET', 'item/get'));
        
        echo $result; // will it print on travis?
        
        $expect = "echo from Wash";
        $this->assertEquals($expect, $result);
    }

}