<?php
class TestCase { }

include $_SERVER['DOCUMENT_ROOT'] . '/tests/WashTestCase.php';
$test = new WashTestCase();


$param1 = "QAZWSXEDCRFVTGBYHNUJMIKLOPÇ";
$param2 = "qazw sx edcrfv tgbyh nuj mik,ol.pç-0";

$r = "get/params-json/$param1/$param2";
$result = $test->requestJson('GET', $r);   

echo json_encode($result);