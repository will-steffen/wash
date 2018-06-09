<?php

include_once 'WashTestCase.php';
use wash\HTTP as HTTP;

class GetControllerTest extends WashTestCase
{
    private $route = 'get';

    public function testDefaultGet ()
    {
        // with end bar
        $result = $this->requestString('GET', $route)['output'];
        $expect = "default GET";
        $this->assertEquals($expect, $result);

        // with no end bar
        $result = $this->requestString('GET', "$route/")['output'];
        $this->assertEquals($expect, $result);
    }

    public function testDefinedGet ()
    {
        // with end bar
        $result = $this->requestString('GET', "$route/defined")['output'];
        $expect = "defined GET";
        $this->assertEquals($expect, $result);

        // with no end bar
        $result = $this->requestString('GET', "$route/defined/")['output'];
        $this->assertEquals($expect, $result);
    }

    public function testError ()
    {
        $result = $this->requestString('GET', "$route/error");        
        $expectString = "error GET";
        $expectCode = HTTP::ERROR;
        $this->assertEquals($expectString, $result['output']);
        $this->assertEquals($expectCode, $result['code']);
    }

    public function testParam ()
    {
        $param = 'Parameter passed';
        $result = $this->requestString('GET', "$route/param/$param")['output'];        
        $expect = "param GET $param";
        $this->assertEquals($expect, $result);
    }

    public function testParams ()
    {
        $param1 = "123456789";
        $param2 = "asdfghjklç";
        $param3 = "@fwerãÃn~nñÑ!#$%Ç";

        $r = "$route/params/$param1/$param2/$param3/";
        $result = $this->requestString('GET', $r)['output'];        
        $expect = "params GET $param1, $param2, $param3";
        $this->assertEquals($expect, $result);
    }

    public function testParamsJson ()
    {
        $param1 = "QAZWSXEDCRFVTGBYHNUJMIKLOPÇ";
        $param2 = "qazw sx edcrfv tgbyh nuj mik,ol.pç-0";

        $r = "$route/params-json/$param1/$param2";
        $result = $this->requestJson('GET', $r)['output'];        
        $expect = "params Json GET";

        $this->assertEquals($expect, $result['message']);
        $this->assertEquals($expect, $result['param1']);
        $this->assertEquals($expect, $result['param2']);
    }  

}