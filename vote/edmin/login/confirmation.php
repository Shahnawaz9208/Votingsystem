<?php
include("../../include/db.php");
?>

<!DOCTYPE html>

<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin</title>

<link type="text/css" href="../../css/bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="../css/theme.css" rel="stylesheet">
<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
</head>

<body style="background-color: #f05f40">
<!-- navbar -->
 <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
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
                        
                        <div class="embed-responsive embed-responsive-16by9 iframe">
                          <iframe class="embed-responsive-item" src="login" allowfullscreen></iframe>
                        </div>

                        <!-- <hr style="background-color: white;"> -->

                        <!-- End Any Page Here -->
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
<script src="../scripts/common.js" type="text/javascript"></script>
<script src="../../js/bootstrap.min.js"></script>


</body>

<?php include('../../include/footer.html'); ?>
</html>

