      <?php 

        error_reporting(E_ALL);
        ini_set('display_errors', '0');

      if(isset($_SESSION['enroll_number'])){ 
        $sql = mysqli_query($con, "SELECT * FROM student_data WHERE enrollment_number = '$en'");
          $row = mysqli_fetch_array($sql);
          $username = $row['name'];
          $enrollment = $row['enrollment_number'];
          $faculty = $row['faculty_number'];
          $department = $row['department'];
      ?>
        <nav class="navbar navbar-expand-sm sticky-top navbar-light bg-light" id="nav">
          <div class="container-fluid">
              <button type="button" id="sidebarCollapse">
                <i class="fa fa-align-left" id="togg"></i>
                <span>
                  <h1 class="site_name">
                    <a href="index">e<span>V</span>oting</a>
                  </h1>
                </span>
              </button>
                <div class="logo">
                    <h1 class="site_name">
                        <a href="index">e<span>V</span>oting</a>
                    </h1>
                </div>
                <nav>
                <ul class="navbar-nav">
                <li class="drop">
                    <span class="dropbtn">
                      <?=$username?>
                    </span>
                    <ul class="dropdown-content">
                      <a><?=$enrollment?></a>
                      <a><?=$faculty?></a>
                      <a><?=$department?></a>
                    </ul>
                  </li>
                    <?php if(!isset($_SESSION['enroll_number'])){?>
                              <li class="nav-item">
                                <a class="nav-link" href="login">Login</a>
                              </li>
                    <?php } if(isset($_SESSION['enroll_number'])){?>
                              <li class="nav-item">
                                <a class="nav-link" href="include/logout">Logout</a>
                              </li>
                    <?php } ?>
              </ul></nav>
            </div>
          </nav>
        <?php } ?>

        <?php if(!isset($_SESSION['enroll_number'])){ ?>
        <nav class="navbar navbar-expand-sm sticky-top navbar-light bg-light" id="nav">
                <div class="container-fluid">

            
                 <h1 class="site_name">
                    <a href="index">e<span>V</span>oting</a>
                 </h1>

                    <nav>
                        <ul class="nav navbar-nav ml-auto">

                    <?php if(!isset($_SESSION['enroll_number'])){?>
                              <li class="nav-item">
                                <a class="nav-link" id="link" href="login">Login</a>
                              </li>
                    <?php } if(isset($_SESSION['enroll_number'])){?>
                              <li class="nav-item">
                                <a class="nav-link" id="link" href="include/logout">Logout</a>
                              </li>
                    <?php } ?>

                        </ul>
                    </nav>
                </div>
        </nav>
        <?php } ?>
