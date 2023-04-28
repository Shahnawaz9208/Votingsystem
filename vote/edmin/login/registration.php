<?php
include("../../include/db.php");
@session_start();

if(isset($_POST['signin'])){
	  $username = stripslashes($_REQUEST['username']);
  	$username = mysqli_real_escape_string($con, $username);
  	$pass = stripslashes($_REQUEST['password']);
  	$pass = mysqli_real_escape_string($con, $pass);
    $password = md5($pass);
  	$email = stripslashes($_REQUEST['email']);
  	$email = mysqli_real_escape_string($con, $email);
  	$number = mysqli_real_escape_string($con, $_REQUEST['number']);
  	$masterpass = stripslashes($_REQUEST['masterpass']);
  	$masterpass = mysqli_real_escape_string($con, $masterpass);
    $pass = md5($masterpass);
    $masterPass = md5($pass);

  	$query = mysqli_query($con,"SELECT admin_password FROM admin ORDER BY id ASC LIMIT 1");
  	$row = mysqli_fetch_array($query);
  	$admin_password = $row['admin_password'];

  	if ($masterPass == $admin_password) {
  		$sql = mysqli_query($con, "INSERT INTO `admin`(`admin_password`, `username`, `password`, `email`, `phone`) VALUES ('NULL', '$username', '$password', '$email', '$number')");
      header('Location:login?S=success');
  	}
  	else{
  		header('Location:login?R=fail');

  	}
}else{
  
}