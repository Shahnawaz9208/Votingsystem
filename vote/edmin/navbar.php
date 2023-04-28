<style>
.dropbtn {
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.drop {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.drop:hover .dropdown-content {
  display: block;
}

.drop:hover .dropbtn {
  background-color: #c1c1c1;
}
</style>
<?php
    $adminname = $_SESSION['username'];
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href="index">eVoting </a>
            <div class="nav-collapse collapse navbar-inverse-collapse">

          
                <ul class="nav pull-right">
                    <li class="nav-user drop"><a class="dropbtn"><i class="icon-chevron-down pull-right" style="color: #555"></i>
                            <img src="./images/user.png" class="nav-avatar" />
                            <!-- <b class="caret"></b> --></a>
                        <ul class="dropdown-content">
                            <a><?=$adminname?></a>
                            <?php
                            echo (!empty($email)?'<a>'.$email.'</a>':'<a>ahad@gmail.com</a>');
                            ?>
                            <!-- <a>Account Settings</a> -->
                            <a href="login/logout">Logout</a>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
