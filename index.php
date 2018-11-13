<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'include/all_include.php';
echo "<pre>";


$obj = new products;
$obj = $obj->get_products();
var_dump($obj);
