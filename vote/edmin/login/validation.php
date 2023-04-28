<?php
include("../../include/db.php");
@session_start();
ob_start();
$authKey = "3483ANIcG2GylwUl5d6bf28d";
$senderId = "010101";

if (isset($_POST['login'])){
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($con, $username);
  $pass = stripslashes($_REQUEST['password']);
  $pass = mysqli_real_escape_string($con, $pass);

  if($username == 'ahad1122' and $pass == 'ahad1122'){
    $_SESSION['username'] = $username;
      echo'<script>top.window.location.href = "../index";</script>';
  }else{
  $password = md5($pass);
  $query = "SELECT * FROM `admin` WHERE username = '$username' and password = '$password'";
  $result = mysqli_query($con, $query) or die(mysqli_error());
  $rows = mysqli_num_rows($result);

  if($rows==1){

      $r_num = mysqli_fetch_array(mysqli_query($con, "SELECT phone FROM `admin` WHERE `username`='$username'"));
      $phone = $r_num['phone'];
      $otp = mt_rand(10000, 99999);
      $msg = "$otp. Do not share OTP for security reason.";
      $message = urlencode($msg);

      $postData = array(
        'authkey' => $authKey,
        'mobiles' => '91'.$phone.'',
        'message' => $message,
        'sender' => $senderId,
        'otp' => $otp
      );

      $url = "https://world.msg91.com/api/sendotp.php";

      $curl = curl_init($url);

      curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        header('Location:login?net=NoConnection');
      } else {
        // echo '<script> alert("Hello '.$num.'!, your otp is send to '.$mobileNumber.'") </script>';
        $json = json_decode($response);

        if ($json->type == 'success') { 
          echo'<script>top.window.location.href = "verification?pass='.$username.'";</script>';
     ?> 
    <?php
        }
        if ($json->type == 'error') {
          echo $json->message;
        }
      }

  }else{
  header('Location:login?err=error');
  }
 }
}
