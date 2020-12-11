<?php

$host = "localhost"; 
$user = "root"; 
$password = ""; 
$dbname = "ddsbe1"; 

$con = mysqli_connect($host, $user, $password,$dbname);

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}