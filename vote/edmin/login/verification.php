<?php
include("../../include/db.php");
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link type="text/css" href="../../css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="../css/theme.css" rel="stylesheet">
  <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
</head>
<body style="background-color: #f05f40">
<!-- navbar -->
 <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    eVoting
  </a>
</nav>
<!-- /navbar -->
<main>    
        <div class="container">
            <div class="row" style="padding: 3% 6% 0 6%;">
              <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div class="content">

                <!-- Start Any Page From Here -->
                  <h2 style="color: white; font-family: serif;";><span style="color: black">ADMIN&ensp;</span> LOGIN / SIGNIN</h2>

          <form method="POST" style="margin-top:70px">
            <hr style="background-color: white; height: 1px;width: 100%">
<?php
$authKey = "3483ANIcG2GylwUl5d6bf28d";
            if(!isset($_GET['pass'])){
              echo '
                <div class="alert alert-success">
                    <center>
                      <strong style="color: #000;font-size: 15px">
                        An OTP is sent to your mobile number. <br>
                        Please enter the OTP which is valid for 10 minutes.
                      </strong>
                    </center>
                  </div>
              ';
            }
if(isset($_POST['verify'])){
	    $username = $_GET['pass'];
      $r_num = mysqli_fetch_array(mysqli_query($con, "SELECT phone FROM `admin` WHERE `username`='$username'"));
      $phone = $r_num['phone'];
      $mobileNumber = '91'.$phone;
      $otp = $_POST['otp'];

        //API URL
  $url = "https://world.msg91.com/api/verifyRequestOTP.php?authkey=$authKey&mobile=$mobileNumber&otp=$otp";
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
        OTP has been verified
      </div>
  <?php
      $_SESSION['username'] = $username;
        echo'<script>location.href = "../index";</script>';
      }
    }
    if (@$json->type == 'error') {
      if($json->message == 'otp_not_verified'){
      ?>

          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            OTP is Invalid
          </div>
       
<?php
      }
      if($json->message == 'already_verified'){ ?>

      <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Already Verified</strong>
      </div>

<?php
      }
   }
}

						?>
				      <div class="form-group login">
				        <div>
				          <label for="user" style="color:white;">OTP:</label>
				          <input type="text" class="form-control" name="otp" placeholder="Enter One Time Password">
				        </div>
				      </div>
				      <input type="submit" class="btn btn-light form-button" name="verify" value="Verify" >

				      <hr style="background-color: white;">
				    </form>
				    </div>
                    <!--/.content-->
                </div>
                <!--/.span8-->
              <div class="col-md-2"></div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
</main>
    <!-- footer -->
<div id="hideme">

<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../scripts/common.js" type="text/javascript"></script>

</body>

<?php include('../../include/footer.html'); ?>
</html>