<?php 
session_start();
ob_start();
$username = $_SESSION['username'];
if(!isset($_SESSION['username'])){
  header('Location: login/confirmation');
}
include '../include/db.php';
$query = mysqli_query($con, "SELECT email FROM admin where username = '$username'");
while($row = mysqli_fetch_array($query)){
  $email = $row['email'];
}
if(isset($_GET['logged-out'])){
  session_destroy();
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php");  ?>
</head>

<body>
  <?php include("navbar.php"); ?>
<main>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php sidebar() ?>

                <div class="span9">
                    <div class="content">

                        <!-- Start Any Page From Here -->
<div class="module">
<div class="module-head" align="center" style="font-size:17px">
    Winners <a class="btn btn-info save" onclick="createPDF()" style="float: right; background-color: #2d2b32;color: #eee;margin-top: -4px;">Download / Print</a>
</div>
<div class="module-body" id="tab">

<ol style="font-size:13pt">
<!-- <ol class="hide"> -->

<?php
  include('../include/db.php');
    
  $sql = mysqli_query($con, "SELECT positions_name FROM `tb_positions`" );
  while($Prow = mysqli_fetch_array( $sql )){
  $position = $Prow['positions_name'];

  // fetching Cabinet winners list
  if($position == 'Cabinet'){
    echo '<li>Cabinet <span style="font-weight:bolder">: </span> </li><br><ul>';
    // fetching Candidates's limit from database 
     $r_max = mysqli_fetch_array(mysqli_query($con, "SELECT positions_limit FROM tb_positions where positions_name = 'Cabinet'"));
     $limit = $r_max['positions_limit'];

    //Displaying the wining Cabinet 
    $sqlCab = mysqli_query($con, "SELECT candidate_cvotes, candidates_name FROM `tb_candidates` WHERE candidates_position = 'Cabinet' ORDER BY candidate_cvotes DESC LIMIT $limit" );
    while($rowCab = mysqli_fetch_array( $sqlCab )){
    $Cab = $rowCab['candidates_name'];
    $vote = $rowCab['candidate_cvotes'];
        echo '
              <li><span style="color:blue">'.$Cab.'</span> (<span style="color:red"> '.$vote.' </span>) </li>
             ';
    }
    echo '</ul><br>';
    // /end of Cabinet's Unordered List
  // Fetching all the positions except Cabinet
  }
  else if($position == 'Court Member'){
    //Displaying the wining Cabinet 
    echo '<li>Court Member <span style="font-weight:bolder">: </span> </li><br>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">College</th>
          <th scope="col"></th>
          <th scope="col">Winner</th>
        </tr>
      </thead>
      <tbody>';
    $sql_court = mysqli_query($con, "SELECT candidates_name, candidates_college, candidate_cvotes FROM `tb_candidates` WHERE candidates_position = 'Court Member' ORDER BY candidate_cvotes DESC" );
    while($row_court = mysqli_fetch_array( $sql_court )){
    $court_member_name = $row_court['candidates_name'];
    $court_member_college = $row_court['candidates_college'];
    $vote = $row_court['candidate_cvotes'];
        echo '
              <tr>
                <td>'. $court_member_college.'</td>
                <td><span style=" float: right;margin-right: 50px;color: darkorange"><i class="fa fa-arrow-right"></i></span></td>
                <td><span style="color:blue">'.$court_member_name.'</span> (<span style="color:red"> '.$vote.' </span>)</td>
              </tr>
             ';
    }
    echo '  </tbody>
          </table><br>';
  }
      
  else{
  $rowSQL = mysqli_query($con, "SELECT candidate_cvotes  AS max, candidates_name AS name FROM `tb_candidates` WHERE candidates_position = '$position' ORDER BY candidate_cvotes DESC LIMIT 1" );
  $row = mysqli_fetch_array( $rowSQL );
  $name = $row['name'];
  $maxVote = $row['max'];
  // echo $largestNumber;
?>
        
          <div style="width: 25%;float: left;">

            <li style=""><?=$position?><span style=" float: right;margin-right: 50px;color: darkorange"> <i class="fa fa-arrow-right"></i> </span>
            </li>

          </div>
          
          <div style="width: 75%;float: right;">

            <span style="color:blue"> <?=$name?> </span> (<span style="color:red"> <?=$maxVote?> </span>) 

          </div><br><br>
        
<?php  }  }  ?>

</ol>

</div>
</div>

<!-- Table. save to pdf -->
<div style="display: none;">
  <div id="tab2">
    <table  class="table table-bordered table-dark">
      <thead>
        <tr><th colspan="2">Voting Results</th></tr>
        <tr>
          <th>Positions</th>
          <th>Candidates</th>
        </tr>
      </thead>
      <tbody>
      
        <?php
          $sl = mysqli_query($con, "SELECT positions_name FROM `tb_positions`" );
          $C= 0;
          while($P = mysqli_fetch_array( $sl )){
            $C++;
          $Po = $P['positions_name'];
            echo '<tr>';

        if($Po == 'Cabinet'){
            echo '<td>'.$C.'. Cabinet</td>';
            // fetching Candidates's limit from database 
             $Rmax = mysqli_fetch_array(mysqli_query($con, "SELECT positions_limit FROM tb_positions where positions_name = 'Cabinet'"));
             $LimiT = $Rmax['positions_limit'];

            //Displaying the wining Cabinet 
            $SqlCab = mysqli_query($con, "SELECT candidate_cvotes, candidates_name FROM `tb_candidates` WHERE candidates_position = 'Cabinet' ORDER BY candidate_cvotes DESC LIMIT $LimiT" );
            echo '<td><ul style="list-style:circle">';
            while($RowCab = mysqli_fetch_array( $SqlCab )){
            $Ca = $RowCab['candidates_name'];
            $Vo = $RowCab['candidate_cvotes'];
              echo '
                <li>
                <span style="color:blue">'.$Ca.'</span> (<span style="color:red"> '.$Vo.' </span>) 
                </li>
                ';
            }

            echo '</ul></td>';

            // /end of Cabinet's Unordered List
          // Fetching all the positions except Court Member

          }else if($Po == 'Court Member'){
              //Displaying the wining Cabinet 
                echo '<td colspan="2">'.$C.'. Court Member</td><br>
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">College</th>
                      <th scope="col">Winner</th>
                    </tr>
                  </thead>
                  <tbody>';
                $sql_court = mysqli_query($con, "SELECT candidates_name, candidates_college, candidate_cvotes FROM `tb_candidates` WHERE candidates_position = 'Court Member' ORDER BY candidate_cvotes DESC" );
                while($row_court = mysqli_fetch_array( $sql_court )){
                $court_member_name = $row_court['candidates_name'];
                $court_member_college = $row_court['candidates_college'];
                $vote = $row_court['candidate_cvotes'];
                    echo '
                          <tr>
                            <td>'. $court_member_college.'</td>
                            <td><span style="color:blue">'.$court_member_name.'</span> (<span style="color:red"> '.$vote.' </span>)</td>
                          </tr>
                        ';
                }
                echo '  </tbody>
                      </table><br>';  
          // Fetching all the positions except Cabinet
          } else {
          $rL = mysqli_query($con, "SELECT candidate_cvotes  AS maxV, candidates_name AS n FROM `tb_candidates` WHERE candidates_position = '$Po' ORDER BY candidate_cvotes DESC LIMIT 1" );
          $r = mysqli_fetch_array( $rL );
          $n = $r['n'];
          $mVote = $r['maxV'];
            echo '<td>'.$C.'. '.$Po.'</td>';
            echo '<td><span style="color:blue">'.$n.'</span> (<span style="color:red"> '.$mVote.' </span>) </td>';
            }
            echo '</tr>';
          } 
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /saving end -->



<!-- More Details about the votes -->
<button class="btn btn-info info" style="width: 100%; height: 40px; font-size: 1.3rem; margin-bottom: 20px;">More</button>

<?php

    $q_ = mysqli_query($con, "SELECT * FROM tb_positions");
    while($row_ = mysqli_fetch_array($q_)){
    $post = $row_['positions_name'];

?>

      <div class="module hide">
        <div class="module-head" align="center">
          <h3><?=$post?></h3>
        </div>
        <div class="module-body">
<?php

  $sql_vCount = mysqli_fetch_array( mysqli_query($con, "SELECT SUM( candidate_cvotes ) AS sum FROM `tb_candidates` where candidates_position = '$post'" ) );
      $total_votes = $sql_vCount['sum'];

    $q_can = mysqli_query($con, "SELECT  candidate_cvotes AS vote, candidates_name, candidates_id FROM tb_candidates WHERE candidates_position='$post' ORDER BY candidate_cvotes DESC");

    while($row_can = mysqli_fetch_array($q_can)){
      $id = $row_can['candidates_id'];
      $naam = $row_can['candidates_name'];
      $votes = $row_can['vote'];

?>
<!-- content in each module -->
<div class="chart">
<div class="name1">
<span style="color:blue"><?=$naam?></span> (<span style="color:red"> <?=$votes?> </span>)
</div>
<div class="box" style="width:75%">
  <div class="bar">
    <?php
      $votePercent = round(($votes/$total_votes)*100);
      $votePercent = !empty($votePercent)?$votePercent.'%':'0%';
      
      
    ?>
    <div class="barSize" id="c_<?=$id?>" style="width: <?=$votePercent;?>;">
      <span class="barText" id="v_<?=$id?>"><?=$votePercent;?></span>
    </div>
  </div>
</div>
</div>
<?php
      if($votePercent == '0%'){
        echo '<script>
            $(document).ready(function(){          
              $("#v_'.$id.'").css("color", "black");
            });   
            </script>
        ';
      }
?>
  <script>
    $(document).ready(function(){
      var colors = ["#8C3CF9","#008080","#FF0000","#21CCFF","#F9953C","#428bca"];                
      var rand = Math.floor(Math.random()*colors.length);           
      $('#c_<?=$id?>').css("background-color", colors[rand]);
    });
  </script>
          <?php } ?>
              </div>
            </div>
      <?php  
        }
      ?>
                        
                        
                        <!-- End Any Page Here -->
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->
</main>
<script>
  $(document).ready(function(){
    $('.info').click(function(){
      $('.hide').toggle();
    });
  });
</script>
<div id="hideme">

</body>
    <!-- footer -->
<?php include('../include/footer.html'); ?>
</html>
<script>
    function createPDF() {
        var sTable = document.getElementById('tab2').innerHTML;
        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=600,width=1000');

        win.document.write('<html><head>');
        win.document.write('<title>Poll Results</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');
        win.document.close();  
        win.print();   
    }
</script>
