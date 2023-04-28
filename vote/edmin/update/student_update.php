<?php 
include "../../include/db.php";

if(isset($_POST['id'])){

$id = $_POST['id'];

if($id > 0){

	// Check record exists
	$checkRecord = mysqli_query($con, "SELECT * FROM student_data WHERE id=".$id);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
		// Delete record
		$query = "DELETE FROM student_data WHERE id=".$id;
		mysqli_query($con, $query);
		echo 1;
		exit;
	}
}

echo 0;
exit;
}
