<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php");  ?>
</head>

<?php
@session_start();
include '../include/db.php';
$username = $_SESSION['username'];
if(!isset($username)){
  header('Location: login/confirmation');
}

  $query = mysqli_query($con, "SELECT email FROM admin where username = '$username'");
  while($row = mysqli_fetch_array($query)){
    $email = $row['email'];
  }
?>

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
    Winners
</div>
<div class="module-body">

<ol style="font-size:13pt">
<!-- <ol class="hide"> -->

<?php
  include('../include/db.php');
    
  $sql = mysqli_query($con, "SELECT positions_name FROM `tb_positions`" );
  while($Prow = mysqli_fetch_array( $sql )){
  $position = $Prow['positions_name'];

  // fetching Cabinet winners list
  if($position == 'Cabinet'){
    echo '<li>Cabinet : </li><ul>';
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
    echo '</ul>';
    // /end of Cabinet's Unordered List
  // Fetching all the positions except Cabinet
  }else{
  $rowSQL = mysqli_query($con, "SELECT candidate_cvotes  AS max, candidates_name AS name FROM `tb_candidates` WHERE candidates_position = '$position' ORDER BY candidate_cvotes DESC LIMIT 1" );
  $row = mysqli_fetch_array( $rowSQL );
  $name = $row['name'];
  $maxVote = $row['max'];
  // echo $largestNumber;
  echo '
        <li>'.$position.' = <span style="color:blue">'.$name.'</span> (<span style="color:red"> '.$maxVote.' </span>) </li><br>
       ';
    }
  }
  
?>

</ol>

</div>
</div>

<button class="btn btn-info info" style="position: relative;left:50%;transform: translateX(-50%); margin-bottom: 20px;">Details</button>

<!-- More Details abouts the votes -->
<?php

    $q_ = mysqli_query($con, "SELECT * FROM tb_positions");
    while($row_ = mysqli_fetch_array($q_)){
    $post = $row_['positions_name'];

?>

      <div class="module hide">
        <div class="module-head">
          <h3><?=$post?></h3>
        </div>
        <div class="module-body">
<?php

	$sql_vCount = mysqli_fetch_array( mysqli_query($con, "SELECT SUM( candidate_cvotes ) AS sum FROM `tb_candidates` where candidates_position = '$post'" ) );
	  	$total_votes = $sql_vCount['sum'];

    $q_can = mysqli_query($con, "SELECT  candidate_cvotes AS vote, candidates_name, candidates_id FROM tb_candidates WHERE candidates_position='$post'");

    while($row_can = mysqli_fetch_array($q_can)){
      $id = $row_can['candidates_id'];
      $naam = $row_can['candidates_name'];
      $votes = $row_can['vote'];
?>
<!-- content in each module -->
<div class="chart">
<div class="name1" style="width: 25%">
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
</main>(
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
