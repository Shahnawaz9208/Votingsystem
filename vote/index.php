<?php 
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

@session_start();
ob_start();
include("include/db.php");
require_once("include/check_voter.php");

$en = $_SESSION["enroll_number"];
$sql_check = "SELECT * FROM `users` WHERE enrollment = '$en'";
$query_check = mysqli_query($con, $sql_check);
  while($row_check = mysqli_fetch_array($query_check)){ 
    $verify = $row_check['verify'];
  }
  
if($verify == 0){
  session_destroy();
  echo '<script>window.location.href="login?otp=not_verified"</script>';
}

if(!isset($en)){
  header('Location: login');
}

$r_max = mysqli_fetch_array(
  mysqli_query(
    $con, "SELECT positions_limit FROM tb_positions where positions_name = 'Cabinet'"
  )
);
$limit = $r_max['positions_limit'];

?>

<html>

<head>
<?php  include ('include/head.php'); ?>
    <script>
        // To limit the canbinet checkbox
        $(document).ready(function() {
            $("input[name='cabinet[]']").change(function() {
                var maxAllowed = '<?= $limit; ?>';
                var checkCounts = $("input[name='cabinet[]']:checked").length;
                if (checkCounts > maxAllowed) {
                    $(this).prop("checked", "");
                    alert('Select maximum ' + maxAllowed + ' Candidates.');
                }
            });
        });
    </script>
</head>

<body style="min-height: 100vh;" onload="preLoader()">
  <div id="preloader"></div>
    <main id="loading">
      <?php include("include/navbar.php"); ?>
        <div class="wrapper">

            <!-- Sidebar  -->
            <nav id="sidebar">
                <ul class="list-unstyled" id="list-hover-slide">
                    <center>
                        <p class="post">Positions</p>
                    </center>
                    <div class="line"></div>
                    <!-- get postions into the side bar -->
                    <?php // getPosition() ?>

                    <script>
                      var position_auto_update = setInterval(() => { 
                        timer()
                      }, 1000);

                      function timer() {
                        var xmlhttp = new XMLHttpRequest();
                          xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                              document.getElementById("position-list").innerHTML = this.responseText;
                            }
                          };
                          xmlhttp.open("GET","positions.php",true);
                          xmlhttp.send(); 
                      };
                          
                    </script>

                    <div id="position-list"></div>

                    <!-- <li><a id="link" href="#">President</a></li> -->
                </ul>
            </nav>

            <!-- Page Content  -->
                <div id="content">
                  <center>
                        <p class="post" style="color:#f40f05 !important;"><b>Candidates</b></p>
                  </center>
                  <div class="line"></div>
                <!-- Get candidates main content -->
                <center><span id="error"></span></center>


<?php
//for saving candidates in database 

    if(isset($_POST['submit'])){

      // print_r($_POST);
      $cab = implode(", ", $_POST['cabinet']);
      $pos_cab = $_POST['pos_cab'];
      $enrol_save = $_POST['enrol_save'];
      
      if ($cab != ''){ 

      $sql_cab=mysqli_query($con, "SELECT voter,position FROM tb_vote where  voter='$enrol_save' and position='$pos_cab'");

    if(mysqli_num_rows($sql_cab)){

        echo "<h3>You have already done your vote for ".$pos_cab."</h3>";
        // header('refresh:1 url=index?post=Cabinet');

    }else{

        $ins=mysqli_query($con, "INSERT INTO tb_vote (voter, position, candidate) VALUES ('$enrol_save', '$pos_cab', '$cab')");
        foreach($_POST['cabinet'] as $index => $val){
        $r = mysqli_query($con, "SELECT * FROM tb_candidates WHERE candidates_name LIKE '%".$val."%'");
        while ($row_cab = mysqli_fetch_array($r)){
          $v = $row_cab['candidate_cvotes'];
          $n = $row_cab['candidates_name'];
        mysqli_query($con, "UPDATE tb_candidates SET candidate_cvotes='$v'+1 where candidates_name='$n'");

         }
    }
        mysqli_close($con);
     
          // echo "<h3 style='color:blue'>Vote for ".$cab." is submitted.</h3>";
          header('Location: index?post=Cabinet');

?>
<script>
// window.location.reload();
      // setTimeout(location.reload.bind(location), 2000);
</script>

<?php
        }
          } else {

     }
  }
//candidates saving ends here 

// call function getCandidates here

getCandidates()

?>

<!-- index landing page do not touch it -->
<?php if(!isset($_GET['post'])){

    $q_ = mysqli_query($con, "SELECT * FROM tb_positions");
    while($ro_ = mysqli_fetch_array($q_)){
    $post_box = $ro_['positions_name'];

?>

      <div class="module">
        <div class="module-head">
          <h3><?=$post_box?></h3>
        </div>
        <div class="module-body">
<?php
    $q_box = mysqli_query($con, "SELECT * FROM tb_candidates WHERE candidates_position='$post_box'");
    while($row_box = mysqli_fetch_array($q_box)){
      $id_box = $row_box['candidates_id'];
      $can_naam = $row_box['candidates_name'];
      $can_pos = $row_box['candidates_position'];
      $can_email = $row_box['candidates_email'];
      $can_pic = $row_box['candidates_pic'];
?>
          <div class="boxs">
            <div class="card-panel">
              <center>
                <?php
                  echo (!empty($can_pic) ? '<img src="img/candidate_profile_pic/'.$can_pic.'" class="thumbnail" alt="'.$can_naam.'">' : '<img src="img/candidate_profile_pic/2.jfif" class="thumbnail" alt="'.$can_naam.'">');
                ?>
              </center>
               <div class="card-body">
                <h5 class="card-title" style="text-align: center;"><?=$can_naam?></h5>
                  <hr>
                <p class="card-text" style="text-align: center;"><?=$can_email?></p>
              </div>
            </div>
          </div>

<!-- <div class="card" style="width: 18rem;display: inline-flex;margin-right:px;margin-bottom:15px;">
  <img class="card-img-top" src="edmin/images/candidate/<?=$can_pic?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?=$can_naam?></h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><?=$can_email?></li>
  </ul>
</div>
 -->

          <?php } ?>
              </div>
            </div>
      <?php  
        }
      }
      ?>
        </div>
      </div>
    </main>
<div id="hideme">
  </body>

<?php include("include/footer.html");  ?>

</html>
