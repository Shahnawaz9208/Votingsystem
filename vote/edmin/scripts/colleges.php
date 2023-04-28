<?php
@session_start(); 
ob_start();
include '../../include/db.php';
    // $query = "select * from tb_colleges";
    // $sql = mysqli_query($con, $query);
    // while ($row = mysqli_fetch_array($sql)){
    // $college_id = $row['colleges_id'];
    // $college_name = $row['colleges'];
    //     // echo "<option value='$college_id'>$college_name</option>";    
    //     echo $college_name;
    // }

    $sql = @mysqli_query($con, "SELECT * FROM tb_colleges");

    $rows = array();
    while($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    
    echo json_encode($rows);
?>
    