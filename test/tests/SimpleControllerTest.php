<?php

include_once 'WashTestCase.php';
use wash\HTTP as HTTP;

class SimpleControllerTest extends WashTestCase
{

    public function testDefaultGet ()
    {
        // with end bar
        $result = $this->requestString('GET', 'simple/')['output'];
        $expect = "SimpleController default GET";
        $this->assertEquals($expect, $result);

        // with no end bar
        $result = $this->requestString('GET', 'simple')['output'];
        $this->assertEquals($expect, $result);
    }

    public function testError500Get ()
    {
        $result = $this->requestString('GET', 'simple/error');        
        $expectString = "SimpleController error GET";
        $expectCode = HTTP::ERROR;
        $this->assertEquals($expectString, $result['output']);
        $this->assertEquals($expectCode, $result['code']);
    }

}