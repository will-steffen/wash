<?php

include_once 'GeneralTest.php';

class ItemTest extends GeneralTest
{

    public function testGet ()
    {
        $result = $this->request('GET', 'item/get');
        
        echo $result; // will it print on travis?
        
        $expect = "echo from Wash -> expected string";
        $this->assertEquals($result, $expect);
    }

}