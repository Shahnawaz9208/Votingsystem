<?php
@session_start();
ob_start();
include("db.php");
$authKey = "6098AdB90Una5e42fed9P123";
$senderId = "102234";

if (($_POST['verifyotp']!="")) {


  $mobileNumber = '91'.$_SESSION['mobile_number'].'';
  $enroll = $_SESSION['enroll_number'];
  $verifyotp = $_POST['verifyotp'];

  //API URL
  $url = "https://world.msg91.com/api/verifyRequestOTP.php?authkey=$authKey&mobile=$mobileNumber&otp=$verifyotp";
  $curl = curl_init($url);

  curl_setopt_array($curl, array(
    //   CURLOPT_URL => "https://control.msg91.com/api/verifyRequestOTP.php?authkey=&mobile=&otp=",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTPHEADER => array(
      "content-type: application/x-www-form-urlencoded"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo '
          <div class="alert alert-success">
            <center>
              <strong style="color: #000;font-size: 15px">
                No internet connection
              </strong>
            </center>
          </div>
         ';
  } else {
    //   echo $response;
    $json = json_decode($response);

    if ($json->type == 'success') { ?>
   
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>OTP has been verified
          </div>
      
<?php
  $trn_date = date("Y-m-d H:i:s");
  $pass = "OTP: $verifyotp";
  $numb = $_SESSION['mobile_number'];


  $sql = "SELECT * FROM `users` WHERE enrollment = '$enroll'";
  $query = mysqli_query($con,$sql);
  while($row=mysqli_fetch_array($query)){
    $ID = $row['id'];
    $enrollment = $row['enrollment'];
  }
    if($enrollment !== $enroll){
        $queryin = "INSERT into `users` (enrollment, phone, trn_date, otp, verify) VALUES ('$enroll',      '$mobileNumber', '$trn_date', '$pass', '1')";
        $resultin = mysqli_query($con, $queryin);
         echo'<script>window.location = "/";</script>';
         }else{
            $queryup = "UPDATE `users` SET enrollment='$enrollment',phone='$mobileNumber',trn_date='$trn_date', otp = '$pass', verify = '1' WHERE id = '$ID'";
            $resultup = mysqli_query($con, $queryup);
           echo'<script>window.location = "/";</script>';
    }

}
}
    if ($json->type == 'error') {
      if($json->message == 'otp_not_verified'){
      ?>

          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            OTP is Invalid</a>
          </div>
       
      <!-- echo 'Your OTP "' . $json->message . '"'; -->
<?php
      }
        if($json->message == 'Maximum execution time of 30 seconds exceeded in'){
        echo 'Server Timeout..';
      }
      
      // if($json->message == 'already_verified'){ ?>

      <!-- <div class="alert alert-info">
        <strong>Already Verified</strong>
      </div> -->

<?php
      // }
    }
  }
?>
