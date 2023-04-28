<?php
@session_start(); 
ob_start();
include 'include/db.php';

    $enroll_id = $_SESSION['enroll_number'];
    
    $run_post = mysqli_query($con, "SELECT * FROM tb_positions");
        while($row = mysqli_fetch_array($run_post)){
            $position_1 = $row['positions_name'];
            $limit = $row['positions_limit'];
            $position = str_replace(" ","-",$position_1);
 
   echo '<li><a id="link" href="post='.$position.'">';
       $get_pos = mysqli_query($con, "SELECT voter,position FROM tb_vote where voter='$enroll_id' and position='$position_1'");
              
       if(mysqli_num_rows($get_pos)){
           echo '<i class="fa fa-check-circle"></i>'; 
       }
       
   echo ''.$position_1.'</a></li>'; 
   } 
   
?>