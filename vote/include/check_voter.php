<?php
    
    $enroll_id = $_SESSION['enroll_number'];
    $q_done = mysqli_query($con, "SELECT * FROM tb_vote WHERE voter = '$enroll_id'");
    $result = mysqli_num_rows($q_done);

    $count = 0;
    $q_count = mysqli_query($con, "SELECT * FROM tb_positions");
    while($row_count = mysqli_fetch_array($q_count)){
    $post_count = $row_count['positions_name'];
        $count++;
    }

    if($result == $count){
        mysqli_query($con, "UPDATE `student_data` SET `voting_status`='Voted' WHERE enrollment_number='$enroll_id'");   
        header("Location: complete");
    }
    else{
        mysqli_query($con, "UPDATE `student_data` SET `voting_status`='Not Voted' WHERE enrollment_number='$enroll_id'");
    }
