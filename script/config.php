<?php

$username =  "epiz_26701999";
$servername = "sql209.epizy.com";
$password = "gFYau1g4X8";
$dbName = "epiz_26701999_testing";

$db = mysqli_connect($servername, $username, $password, $dbName);

if(!$db){
    die("Connection failed.");
}
