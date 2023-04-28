<?php @session_start(); ob_start(); ?>
<!DOCTYPE html>
<html>

<head>
<?php include("include/head.php");?>
</head>

<body style="background-image: linear-gradient(to bottom right, #f04040, #f05f40);min-height: 100vh;"> 
    <main>
        <?php include("include/db.php");?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav">
                <div class="container-fluid">

            <div class="">
                 <h1 class="site_name">
                    <a href="include/logout.php">e<span>V</span>oting</a>
                 </h1>
            </div>

                    <nav>
                        <ul class="nav navbar-nav ml-auto">

                    <?php if(!isset($_SESSION['enroll_number'])){?>
                              <li class="nav-item">
                                <a class="nav-link" id="link" href="include/logout.php">Login</a>
                              </li>
                    <?php } if(isset($_SESSION['enroll_number'])){?>
                              <li class="nav-item">
                                <a class="nav-link" id="link" href="include/logout.php">Logout</a>
                              </li>
                    <?php } ?>

                        </ul>
                    </nav>
                </div>
        </nav>
<?php
$enroll_id = $_SESSION['enroll_number'];
    $S = "SELECT name FROM student_data WHERE enrollment_number = '$enroll_id'";
    $Q = mysqli_query($con, $S);
    $R = mysqli_fetch_array($Q);
    $name = $R['name'];
?>
   <div class="container">
    <div style="padding: 4% 0 0 10%;">
        <div class="col-md-1"> </div>
        <div class="col-md-10"> <h2 style="color: #fff; font-family:  Arial";>VOTING COMPLETED</h2>
          <!-- <h5 style="margin-top: -12px">Thank you, <u style="color: #222"><?=$name?></u></h5> -->
          <hr style="background-color: white; height: 1px;">    
    <div class="section" style="padding:0 0 0 20px">
<?php

    $sql = "SELECT * FROM tb_vote WHERE voter = '$enroll_id' ORDER BY position DESC";
    $query = mysqli_query($con, $sql);
    while($row_done = mysqli_fetch_array($query)){
    $voter = $row_done['voter'];
    $position = $row_done['position'];
    $candidate = $row_done['candidate'];
        ?>
        
          <div style="width: 30%;float: left;">

            <h5 style="color:#f1f1f1"><?=$position?><span style="color:#000; float: right;margin-right: 50px;color: brown"> <i class="fa fa-arrow-right"></i> </span>
            </h5>

          </div>
          
          <div style="width: 70%;float: right;">

            <h5 style="color:#f1f1f1"> <?=$candidate?> </h5>

          </div><br><br>
        
        <?php
        
     }
  
?>

</div>
<a href="include/logout.php">
<button style="border-radius: 60px; padding: 15px 30px;" type="submit" class="btn btn-light">Logout
</button>
</a>


  <hr style="background-color: white;">
        </div>

    
</div>
</div>
</main>
<div id="hideme" style="display: none;">
</body>
<?php include ('include/footer.html'); ?>

</html>
