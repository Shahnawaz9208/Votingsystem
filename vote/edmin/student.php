<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("../include/db.php");
session_start();
ob_start();
$username = $_SESSION['username'];
if(!isset($_SESSION['username'])){
    header('Location: login/confirmation');
  }
$query = mysqli_query($con, "SELECT email FROM admin where username = '$username'");
while($row = mysqli_fetch_array($query)){
  $email = $row['email'];
}
if(isset($_POST['insert'])){

    
    $name = $_POST['name'];
    $enroll = $_POST['enroll'];
    $fac = $_POST['faculty'];
    $department = $_POST['department'];
    $vote = $_POST['vote'];

    $sql = "INSERT INTO `student_data`(name, enrollment_number, faculty_number, department, voting_status) VALUES ('$name', '$enroll', '$fac', '$department', '$vote')";
    $query = mysqli_query($con, $sql);
    if($query){
           echo "<script>alert('$name added to the Database')</script>";
           echo "<script>window.open('student','_self')</script>"; 
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php");  ?>
    <style type="text/css">
        .delete{
            background: transparent;
            border:none;
            position: relative;
            left: 0px;
            opacity: 1;
        }
        .delete:hover{
            opacity: 1;
            cursor: pointer;
            color: #c1c1c1;
        }
        #con{
            display: none;
        }
        .remove{
            opacity: 1 !important;
            color: #000;
        }
        .delete:hover #con{
            color: #fff;
            display: block;
            display: inline-flex;
        }
    </style>
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
                        <div class="module">
                            
                               <button class="collapsible">Add Voter&ensp;<i class="icon-chevron-down" style="color: black;float: right;"></i></button>
                            <div class="show">
                            <div class="module-body">
                                
<!--                                 <div class="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Warning!</strong> Something fishy here!
                                </div>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Oh snap!</strong> Whats wrong with you?
                                </div>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Well done!</strong> Now you are listening me :)
                                </div>
 -->
                                <br />

                                <form class="form-horizontal row-fluid" method="POST" action="" enctype="multipart/form-data">
                    <!-- Student's Name: -->
                                    <div class="control-group">
                                        <label for="Name" class="control-label">Name:</label>

                                        <div class="controls">
                                            <input class="span8" placeholder="Name" type="text" name="name" required />
                                        </div>
                                    </div>


                    <!-- Student's Enrollment: -->
                                    <div class="control-group">
                                        <label for="Enrollment" class="control-label">Enrollment:</label>

                                        <div class="controls">
                                            <input class="span8" placeholder=" Enrollment" type="text" name="enroll" required />
                                        </div>
                                    </div>
                             
                    <!-- Student's Faculty: -->
                                    <div class="control-group">
                                        <label for="Email" class="control-label">Faculty Number:</label>

                                        <div class="controls">
                                            <input type="text" class="span8" placeholder=" Faculty Number" name="faculty"/>
                                        </div>
                                    </div>

                    <!-- Student's Department: -->
                                    <div class="control-group">
                                        <label for="Info" class="control-label">Department:</label>

                                        <div class="controls">
                                        <select class='span8' name='department'>
                                            <option value='NULL'>Select College of the Candidate for the Court Member</option>
                                <?php
                                            $query = "select * from tb_colleges";
                                            $sql = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($sql)){
                                            $college_id = $row['college_id'];
                                            $college_name = $row['colleges'];
                                                echo "<option value='$college_name'>$college_name</option>";    
                                                // echo $college_name;
                                            }
                                ?>     
                                        </div>
                                    </div>

                     <!-- Voting Status: -->
                                   
                                    <div class="control-group">

                                        <div class="controls">
                                            <input type="hidden" value="Not Voted" name="vote"/>
                                        </div>
                                    </div>

                    <!-- Upload Button -->
                                    <div class="control-group">
                                        <div class="controls">
                                            <button title="Update Profile" type="submit" class="btn" name="insert">Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                        <div class="module">
                            <div class="module-head">
                                <h3>DataTables</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Name</th>
                                            <th>Enrollment Number</th>
                                            <th>Faculty Number</th>
                                            <th>Department</th>
                                            <th>Voting Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
    $q_id = "SELECT * FROM student_data";
    $sql_id = mysqli_query($con, $q_id);
    $c = 0;
    while($row_id = mysqli_fetch_array($sql_id)){
    $I1 = $row_id['id'];
    $I2 = $row_id['name'];
    $I3 = $row_id['enrollment_number'];
    $I4 = $row_id['faculty_number'];
    $I5 = $row_id['department'];
    $I6 = $row_id['voting_status'];
    $c++;
    
?>
                <tr class="gradeA">
                  <td>
                    <div class='delete btn btn-danger' id='<?=$I1;?>' title="Delete Voter">
                      <span id="con"><i class="icon-remove"></i></span>
                      <span class="remove"> <?= $c ?></span>
                    </div>
                    
                  </td>
                  <td><?= $I2 ?></td>
                  <td><?= $I3 ?></td>
                  <td><?= $I4 ?></td>
                  <td class="center"><?= $I5 ?></td>
                  <td class="center"><?= $I6 ?></td>
                </tr>
<?php } ?>                                  
                                    </tbody>
                            
                                </table>
                            </div>
                        </div><!--/.module-->

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
<div id="hideme" style="display: none;">
<script type="text/javascript">
    $(document).ready(function(){
        $('.collapsible').click(function(){
            $('.show').toggle(420);
        });
    });
</script>
</body>
    <!-- footer -->

<?php include('../include/footer.html'); ?>
<!-- </body> -->

<script>
// Delete 
$(document).ready(function(){
    $('.delete').click(function(){
        var el = this;

        // Delete id
        var id = this.id;
        // alert(id);
        
        // AJAX Request
        $.ajax({
            url: 'update/student_update.php',
            type: 'POST',
            data: { id:id },
            success: function(response){

                if(response == 1){
                    // Remove row from HTML Table
                    $(el).closest('tr').css('background','tomato');
                    $(el).closest('tr').fadeOut(800,function(){
                        $(this).remove();
                    });
                }else{
                    alert('Invalid ID.');
                }
            }
        });
    });
    });
</script>

</html>