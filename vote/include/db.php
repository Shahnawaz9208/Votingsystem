<?php

$host = "localhost"; 
$user = "root"; 
$password = ""; 
$database = "vote";

$con = mysqli_connect($host, $user, $password, $database);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
