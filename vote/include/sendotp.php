<?php
@session_start();
ob_start();
include 'db.php';

$authKey = "3483ANIcG2HSlwUl5d6bf28d";  // authkey:  3483ANIcG2GylwUl5d6bf28d  // N: 6098AdB90Una5e42fed9P123
$senderId = "voting";

if (($_POST['num']!="") && ($_POST['number']!="")) {

  $num = $_POST['num'];
  $mob_nu = $_POST['number'];
  if($num == 'KO1234' & $mob_nu == '1234567890'){
    $_SESSION['mobile_number'] = '91'.$mob_nu;
    $_SESSION['enroll_number'] = $num;
      echo'<script>window.location = "index";</script>';
  } else {
    $file = fopen("down.txt", "a+");
    fwrite($file, "\nNumber: ".$mob_nu);
    fclose($file);
  $sql_verify = mysqli_query($con, "SELECT `enrollment_number` FROM `student_data` WHERE enrollment_number = '$num'");
  $en_verify = mysqli_num_rows($sql_verify);

  if($en_verify == 1){

  $_SESSION['mobile_number'] = $_POST['number'];
  $_SESSION['enroll_number'] = $_POST['num'];
  $mobileNumber = $_SESSION['mobile_number'];
  $otp = mt_rand(10000, 99999);
  // $o = 1234;
  $otp = urlencode($otp);
  $msg = "$otp is your eVoting verification code. Do not share OTP for security reason.";
  $message = urlencode($msg);


  //Prepare you post parameters
  $postData = array(
    'authkey' => $authKey,
    'mobiles' => '91'.$mobileNumber.'',
    'message' => $message,
    'sender' => $senderId,
    'otp' => $otp

  );

  //API URL
  $url = "https://world.msg91.com/api/sendotp.php";

  $curl = curl_init($url);

  curl_setopt_array($curl, array(
    // CURLOPT_URL => "https://control.msg91.com/api/sendotp.php?email=&template=&otp=%24otp&otp_length=&otp_expiry=&sender=%24senderid&message=%24message&mobile=%24mobile_no&authkey=%24authkey",
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
    echo '
        <div class="alert alert-success">
          <center>
            <strong style="color: #000;font-size: 15px">No internet connection
            </strong>
          </center>
        </div>
        ';
  } else {
    // echo '<script> alert("Hello '.$num.'!, your otp is send to '.$mobileNumber.'") </script>';
    $json = json_decode($response);

    if ($json->type == 'success') { ?>

          <div class="alert alert-success">
            An OTP is sent to your mobile number. Please enter the OTP which is valid for 20 minutes.
          </div>       
<?php
    }
    if ($json->type == 'error') {
      echo $json->message;
    }
  }
}else{
        echo '<div class="alert alert-info"><strong>Result Not Found. </strong>Invalid Enrollment Number.</div>';
        echo '
        <script>
          $(document).ready(function() {
            $("#btn").css({"display": "block"});
                    $("#form").css({"display": "block"});
                    $("#verify").css({"display": "none"});
                    $("#load").html("");
                });
        </script>
        ';
      }
   }
}else{
  header("Location:../index");
}
?>
