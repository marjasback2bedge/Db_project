<?php
if(!defined('DB_SERVER')){
    require_once("initialize.php");
}

$servername = DB_SERVER;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;

$conn = new mysqli($servername, $username, $password, $dbname);

?>