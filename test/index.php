<?php

if($_SERVER['REQUEST_URI'] == '/debugtest'){
    include 'local-test.php';
}else{
    require $_SERVER['DOCUMENT_ROOT'] . '/wash/loader.php';
    $wash = new wash\Wash();
    $wash->go();
}
