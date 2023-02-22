<?php

$engine = ((strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) ? dirname(__DIR__, 1) .'/engine' : dirname(__DIR__, 1) .'/engine.tomdenley.com');
$this_url = ((strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) ? __DIR__ : dirname(__DIR__, 1) .'/sowallace.co.uk');

set_include_path($engine);
header('Access-Control-Allow-Headers: X-Requested-With');
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Origin: ". get_include_path() ."/index.php");
include_once(get_include_path() .'/index.php');

?>