<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

include('include/db.php');
 $vote = $_REQUEST['vote'];
  $user_id = $_REQUEST['user_id'];
   $position = $_REQUEST['position'];

$sql=mysqli_query($con, "SELECT voter,position FROM tb_vote where  voter='$user_id' and position='$position'");

	if(mysqli_num_rows($sql)){
    	echo "<h3>You have already done your vote for ".$position."</h3>";
	}else{
    
    	//insert data and check position
    	$ins=mysqli_query($con, "INSERT INTO tb_vote (voter, position, candidate) VALUES ('$user_id', '$position', '$vote')");
    	mysqli_query($con, "UPDATE tb_candidates SET candidate_cvotes=candidate_cvotes+1 WHERE candidates_name='$vote'");
    	mysqli_close($con);
 
			echo "<h3 style='color:blue'>Vote for ".$vote." is submitted.</h3>";
	}
