<?php

// [W]eb [A]pi for [S]hared [H]osting
require $_SERVER['DOCUMENT_ROOT'] . '/wash/loader.php';
use wash\Wash as Wash;


// Here you can define configs of your code
// define('MY_CONFIG', 'some config string');


$wash = new Wash();
$wash->go();