<?php namespace wash;

header("Access-Control-Allow-Origin: *");

class Controller extends WashClass 
{

    public $washGuardService;

    
    public function json ($obj, int $code)
    {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($code);
        echo json_encode($obj);
    }

    public function string (string $obj, int $code)
    {  
        http_response_code($code);
        echo $obj;
    }

}
