<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
$connection=null;
try{
$connection=new PDO("mysql:host=localhost;dbname=retrofitappdb;charset=utf8","root","");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(Exception $ex){
    echo json_encode(array("response"=>"Error: " . $ex->getMessage(),"News"=>null));
$connection=null;
}
?>