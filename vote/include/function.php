<?php
@session_start(); ob_start();
include 'db.php';
function getPosition(){
    
     global $con;
                $enroll_id = $_SESSION['enroll_number'];
                $run_post = mysqli_query($con, "SELECT * FROM tb_positions");
                while($row = mysqli_fetch_array($run_post)){
                $position_1 = $row['positions_name'];
                $limit = $row['positions_limit'];
                $position = str_replace(" ","-",$position_1);

        
    echo '<li><a id="link" href="post='.$position.'">';
        $get_pos = mysqli_query($con, "SELECT voter,position FROM tb_vote where voter='$enroll_id' and position='$position_1'");
        $nur = mysqli_num_rows($get_pos);
        echo $nur;  
        if(mysqli_num_rows($get_pos)){
            echo '<i class="fa fa-check-circle"></i>'; 
        }
        
    echo ''.$position_1.'</a></li>'; 
    } 
       
}


function getCandidates(){
 
//    if(!isset($_GET['position'])){
//    header('Location: index.php?position=President');
// }
if(isset($_GET['post'])){
  $id_1 = $_GET['post'];
  $id = str_replace("-"," ",$id_1);
  $user_enroll = $_SESSION['enroll_number'];


  global $con;

  $sql_coll = "SELECT * FROM student_data WHERE enrollment_number = '$user_enroll'";
  $query_coll = mysqli_query($con, $sql_coll);
  $data_coll = mysqli_fetch_array($query_coll);
    $college = $data_coll['department'];
    


    $en = $_SESSION['enroll_number'];
    $sql_pos = "SELECT * FROM tb_candidates WHERE candidates_position = '$id'";
    $query_pos = mysqli_query($con, $sql_pos);
    $r = mysqli_fetch_array($query_pos);
    $pos = $r['candidates_position'];
    echo '<form class="form" method="post">  
            <div class="module">
                <div class="module-head">
                    <h3>'.$pos.'</h3>
                </div>
         ';
if($id == 'Court Member'){

    $court_college = "SELECT * FROM tb_candidates WHERE candidates_position = '$id' and candidates_college = '$college'";
    $query_college = mysqli_query($con, $court_college);
    $i = 0;
    while($row_coll = mysqli_fetch_array($query_college)){
    $i++;
    $ID = $row_coll['candidates_id'];
    $name = $row_coll['candidates_name'];
    $post = $row_coll['candidates_position'];
    $email = $row_coll['candidates_email'];
    $info = $row_coll['candidates_info'];
      echo '
            <div class="module-body">
              <div class="form-check">
                  <input class="form-check-input" type="radio" id="'.$i.'" name="vote" value="'.$name.'">
                <label class="form-check-label" for="'.$i.'">'.$name.'</label>
              </div>
            </div>
            ';
    }
        echo' 
            <input type="hidden" id="str" value="'.$id.'">
            <input type="hidden" id="hidden" value="'.$en.'">
            <span id="save" class="btn btn-block btn-outline-dark" onclick = "getVote()">Submit Your Vote</span>
                 
        </div>
        ';
// For cabinet input
      }
      else if($id !== 'Cabinet'){
        $query_post = mysqli_query($con, $sql_pos);
    $i = 0;
    while($row_ = mysqli_fetch_array($query_post)){
    $i++;
    $ID = $row_['candidates_id'];
    $name = $row_['candidates_name'];
    $post = $row_['candidates_position'];
    $email = $row_['candidates_email'];
    $info = $row_['candidates_info'];
      echo '
            <div class="module-body">
              <div class="form-check">
                  <input class="form-check-input" type="radio" id="'.$i.'" name="vote" value="'.$name.'">
                <label class="form-check-label" for="'.$i.'">'.$name.'</label>
              </div>
            </div>
            ';
    }
        echo' 
            <input type="hidden" id="str" value="'.$id.'">
            <input type="hidden" id="hidden" value="'.$en.'">
            <span id="save" class="btn btn-block btn-outline-dark" onclick = "getVote()">Submit Your Vote</span>
                 
        </div>
        ';
      }
      else{

    $query_post = mysqli_query($con, $sql_pos);
    $i = 0;
    while($row_ = mysqli_fetch_array($query_post)){
    $i++;
    $ID = $row_['candidates_id'];
    $name = $row_['candidates_name'];
    $post = $row_['candidates_position'];
    $email = $row_['candidates_email'];
    $info = $row_['candidates_info'];
      echo '
            <div class="module-body">
              <div class="form-check">
                  <input class="single-checkbox" type="checkbox" id="'.$i.'" name="cabinet[]" value="'.$name.'">
                <label class="form-check-label" for="'.$i.'">'.$name.'</label>
              </div>
            </div>
            ';
    }
        echo'
        <input type="hidden" name="pos_cab" id="str" value="'.$id.'">
        <input type="hidden" name="enrol_save" id="hidden" value="'.$en.'">
        
        <input type="submit" name="submit" class="btn btn-block btn-outline-dark" value="Submit Your Vote">      
        </div>

        ';

     } 
  }
}