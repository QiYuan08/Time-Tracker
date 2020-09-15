<?php

$username =  "root";
$servername = "localhost";
$password = "";
$dbName = "table1";

$db = mysqli_connect($servername, $username, $password, $dbName);

if(!$db){
    die("Connection failed.");
}
