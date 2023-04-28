<head>
  <link type="text/css" href="../../css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <style>
      ::-webkit-scrollbar {
        width: auto;
      }
      ::-webkit-scrollbar-thumb {
        overflow: none;
      }
      .login div label, .signup div label{
        font-size: 18px;
      }
      .signup{
        display: none;
      }
      .bar{
        text-align: center;
        justify-content: center;
        color: black;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        background-color: white;
        padding: 12px 0;
        display: inline-flex;
        width: 50%;
        /*border-radius: 2px;*/
      }
      .bar:hover{
        background-color: #e1e1e1;
      }
      .form-button{
        border-radius:60px;
        padding: 14px 42px;
        font-size: 16px
      }
    </style>
</head>
  <body style="background-color: #f05f40">
    <hr style="background-color: white; height: 1px;width: 100%">

      <div class="bar" onclick="loginDiv()">
        <span>Login</span>
      </div>
      <div class="bar" style="float: right;" onclick="registerDiv()">
        <span>Sign Up</span>
      </div>
                        
    <hr style="background-color: white; height: 1px;width: 100%">
    <?php if(isset($_GET['S'])){ ?>
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <center>
          <strong style="color: #000;font-size: 15px">
            Registration Successfull.
          </strong>
        </center>
      </div>
                            
    <?php } if(isset($_GET['R'])){ ?>

      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <center>
          <strong style="color: #000;font-size: 15px">Registration Failed.
          </strong>
        </center>
      </div>               
    <?php } ?>

    <?php if(isset($_GET['net'])){ ?>
      <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <center>
          <strong style="color: #000;font-size: 15px">No internet connection
          </strong>
        </center>
      </div>    
                     
    <?php } if(isset($_GET['err'])){ ?>
      
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <center>
            <strong style="color: #000;font-size: 15px">
               Username/password is incorrect.
            </strong>
          </center>
      </div>               
    <?php } ?>
                         
    <form method="POST" action="validation.php">
      <div class="form-group login">
        <div>
          <label for="user" style="color:white;">Username:</label>
          <input type="text" class="form-control" name="username" placeholder="Enter username (without spaces)" autocomplete="off">
        </div>
        <div>
          <label for="pass" style="color:white;">Password:</label>
          <input type="password" class="form-control" name="password" placeholder="Enter Password"  autocomplete="off">
        </div>
        <br />              
          <input type="submit" class="btn btn-light form-button" name="login" value="Login" >
      </div>
    </form>
                      

    <form method="POST" action="registration.php" enctype="multipart/form-data">
      <div class="signup">
        <div>
          <label for="username" style="color:white;">Username:</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter username (without spaces)">
        </div>

        <div>
          <label for="password" style="color:white;">Password:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
        </div>

        <div>
          <label for="email" style="color:white;">Email Address:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
        </div>

        <div>
          <label for="number" style="color:white;">Mobile Number:</label>
          <input type="text" class="form-control" id="number" name="number" placeholder="Enter your 10 digit mobile number" minlength="10" maxlength="10">
        </div>

        <div>
          <label for="password1" style="color:white;">Master Password:</label>
          <input type="password" class="form-control" id="password1" name="masterpass" placeholder="Enter the correct password to continue">
        </div>
        <br />

      <input type="submit" class="btn btn-light form-button" name="signin" value="Sign In" >
      </div>

      <hr style="background-color: white;">

    </form>

  <script src="../../js/jquery.min.js"></script>
  <script src="../scripts/common.js" type="text/javascript"></script>

    <?php 
      if(isset($_GET['R'])){
      echo '<script>
            $(document).ready(function() {
              $(".login").hide();
              $(".signup").show();
            });
            </script>
            ';
        }
    ?>
<script src="../../js/bootstrap.min.js"></script>
</body>