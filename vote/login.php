<?php
include ('include/head.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>eVoting</title>
</head>

<body onload="preLoader()">
    <div id="preloader"></div>
    <main>
        <?php include("include/navbar.php"); ?>
        <div class="container">
            <div class="row" style="padding: 8% 6% 0 6%;">
                <div class="col-md-1"> </div>
                <div class="col-md-10">
                    <!-- <h2 style="color: #101010; font-family:  Arial;">LOGIN</h2> -->
                    <hr style="background-color: white; height: 1px;">
                    <div class="message_box" style="font-size:18px"></div>

                    <?php if(isset($_GET['otp'])){
                        echo'<div class="message_box" style="font-size:18px">OTP Not Verified</div>';
                    } ?>
                    <form id="form">
                        <!-- Enrollment number -->
                        <label for="num" style="color:white" ;>Enrollment Number:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">&ensp;En.</span>
                            </div>
                            <input type="text" class="form-control" id="num" placeholder="Enrollment Number" oninput="this.value = this.value.toUpperCase()" autoComplete="off" maxlength="6" />
                        </div>

                        <!-- Colllege -->
                        <!-- <label for="college" style="color:white" ;>Select College:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">College</span>
                            </div>
                            <div class="colleges_list"></div>
                        </div> -->

                        <!-- Mobile Number -->
                        <label for="number1" style="color:white" ;>Mobile Number:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+91</span>
                            </div>
                            <input type="text" class="form-control" autoComplete="off" placeholder="Enter 10 Digit Mobile Number" id="number" maxlength="10">
                        </div>

                    </form>

                    <div id="verify" style="display:none;">
                      <form>
                        <label for="num1" style="color:white" ;>Enrollment Number:</label>
                        <div class="input-group mb-3">
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">&ensp;En.</span>
                            </div>
                            <input type="text" class="form-control" id="num1" style="text-transform: uppercase;" readonly>
                        </div>

                        <label for="number1" style="color:white" ;>Mobile Number:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+91</span>
                            </div>
                            <input type="text" class="form-control" id="number1" readonly>
                        </div>

                        <label for="otp" style="color:white">Enter OTP</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">otp</span>
                            </div>
                            <input type="number" class="form-control" id="verifyotp" autoComplete="off" placeholder="One Time Password (OTP)" />
                        </div>
                            
                      </form>
<button id="verifyOtp" type="submit" class="btn btn-light" style="border-radius:60px;padding: 14px 52px;">Submit <div id="load1"></div></button>
                    </div>

                    <button id="btn" type="submit" class="btn btn-light">Generate OTP <div id="load"></div></button>
                    <hr style="background-color: white;">
                </div>
            </div>
        </div>
    </main>
    <div id="hideme">
</body>
<?php include ('include/footer.html'); ?>
<script type="text/javascript">
    $('#num').keyup(function() {
        $('#num1').val($(this).val()); // <-- reverse your selectors here
    });
    $('#num1').keyup(function() {
        $('#num').val($(this).val()); // <-- and here  
    });

    $('#number').keyup(function() {
        $('#number1').val($(this).val()); // <-- reverse your selectors here
    });
    $('#number1').keyup(function() {
        $('#number').val($(this).val()); // <-- and here  
    });

</script>

</html>