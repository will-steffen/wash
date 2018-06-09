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
        $result = $this->requestString('GET', 'simple/error')['code'];
        $expect = HTTP::ERROR;
        $this->assertEquals($expectCode, $result);
    }

}