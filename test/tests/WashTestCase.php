<?php

use PHPUnit\Framework\TestCase as TestCase;
$basePath = str_replace('tests', '', __DIR__);
require $basePath . 'wash/enums.php';

class WashTestCase extends TestCase
{
    private $serverUrl = "http://localhost/";

    public function requestString ($method, $url, $data = false)
    {
        $method = strtoupper($method);
        $url = $this->serverUrl . $url;        

        // from: https://stackoverflow.com/questions/9802788/call-a-rest-api-in-php
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
    
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
    
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
           
        $output = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
        curl_close($curl);
    
        return array(
            "output" => $output,
            "code" => $httpcode
        );

    }

    public function requestJson ($method, $url, $data = false)
    {
        $result = $this->requestString($method, $url, $data);
        $result['output'] = json_encode($result['output']);
        return $result;
    }

} 