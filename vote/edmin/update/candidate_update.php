<?php 
include "../../include/db.php";

if(isset($_POST['id'])){

$id = $_POST['id'];

if($id > 0){

	// Check record exists
	$checkRecord = mysqli_query($con, "SELECT * FROM tb_candidates WHERE candidates_id=".$id);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
		// Delete record
		$query = "DELETE FROM tb_candidates WHERE candidates_id=".$id;
		mysqli_query($con,$query);
		echo 1;
		exit;
	}
}

echo 0;
exit;
}
else{

$id1 = $_POST['id1'];
$name = $_POST['name'];
$pos = $_POST['pos'];
$mail = $_POST['mail'];


if($id1 > 0){

	// Check record exists
	$checkRecord = mysqli_query($con, "SELECT * FROM tb_candidates WHERE candidates_id=".$id1);
	$totalrows = mysqli_num_rows($checkRecord);
	$row = mysqli_fetch_array($checkRecord);
	$cvote = $row['candidate_cvotes'];
	$pic = $row['candidates_pic'];

	if($totalrows > 0){
		// Delete record
		$query = "UPDATE `tb_candidates` SET `candidates_id`='$id1' , `candidates_name`='$name' , `candidates_position`='$pos' , `candidates_email`='$mail' , `candidates_pic`='$pic' , `candidate_cvotes`='$cvote' WHERE  candidates_id=".$id1;
		mysqli_query($con,$query);
		echo 1;
		exit;
	}
}

echo 0;
exit;
}
