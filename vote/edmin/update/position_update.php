<?php 
include "../../include/db.php";

if(isset($_POST['id'])){

$id = $_POST['id'];

if($id > 0){

	// Check record exists
	$checkRecord = mysqli_query($con, "SELECT * FROM tb_positions WHERE positions_id=".$id);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
		// Delete record
		$query = "DELETE FROM tb_positions WHERE positions_id=".$id;
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
$pos = $_POST['pos'];

if($pos == 'Cabinet'){
	$max_ca = $_POST['max_ca'];
}else{
	$max_ca = 0;
}

if($id1 > 0){

	// Check record exists
	$checkRecord = mysqli_query($con, "SELECT * FROM tb_positions WHERE positions_id=".$id1);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
		// Delete record
		$query = "UPDATE `tb_positions` SET `positions_id`='$id1' , `positions_name`='$pos' , `positions_limit`='$max_ca' WHERE  positions_id=".$id1;
		mysqli_query($con,$query);
		echo 1;
		exit;
	}
}

echo 0;
exit;
}
