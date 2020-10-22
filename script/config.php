<?php

$username =  "root";
$servername = "localhost";
$password = "";
$dbName = "hosting";

$db = mysqli_connect($servername, $username, $password, $dbName);

if(!$db){
    die("Connection failed.");
}
