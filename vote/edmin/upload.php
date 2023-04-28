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

    $q_id = "SELECT candidates_id FROM tb_candidates ORDER BY candidates_id DESC LIMIT 0,4";
    $sql_id = mysqli_query($con, $q_id);
    $row_id = mysqli_fetch_array($sql_id);
    $I = $row_id['candidates_id'];

    $id = $I + 1;
    $name = $_POST['can_name'];
    $post = $_POST['position'];
    $college = $_POST['college'];
    $mail = $_POST['email'];
    $image = $_FILES['image']['name'];
    $target = "../img/candidate_profile_pic/".basename($image);

    $sql = "INSERT INTO `tb_candidates`(candidates_id, candidates_name, candidates_position, candidates_college, candidates_email, candidates_pic) VALUES ('$id', '$name', '$post', '$college', '$mail', '$image')";
    $query = mysqli_query($con, $sql);
    if($query){
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
           echo "<script>alert('$name added as a $post')</script>";
           echo "<script>window.open('upload','_self')</script>"; 
    } 
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php");  ?>
    <style>
        ::-webkit-scrollbar { width: 0 !important }
        #max{
            display: none;
        }
        table {
          border-collapse: collapse;
          width: 100%;
        }

        th{
          padding: 8px;
          text-align: left;
        }
        td{
          padding: 10px;
          text-align: left;
          border-bottom: 1px solid #ddd;
        }
        #na {
            width: 178px;
            position: relative;
            left: 10px;
            border-bottom: none;
        }
        td input[type="text"]{
          width: 110px;
        }
        td select{
          width: 133px;
        }
        tr:hover {background-color:#f5f5f5;}

        .delete:hover{
            cursor: pointer;
            color: #c1c1c1;
        }
        .edit:hover{
            cursor: pointer;
            color: #000;
        }
        .college{
          display: none;
        }
        .college-collapse-data{
          display:none;
        }
        .college-collapse{
          float:right !important;
          color:#666;
          cursor: default;
          margin-right: 5%;
        }
        .college-collapse:hover{
          color:#000;
          cursor: pointer;
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
           <div class="span10">
              <div class="content">
                <div class="al"></div>
                <div class="module">                  
                  <button class="collapsible">Add Candidate&ensp;<i class="icon-chevron-down" style="color: black;float: right;"></i></button>
                    <div class="show">
                      <div class="module-body">
                        <form class="form-horizontal row-fluid" method="POST" action="upload.php" enctype="multipart/form-data">

<!-- Candidate's Name: -->
                    <div class="control-group">
                      <label for="Name" class="control-label">Candidate's Name:</label>
                        <div class="controls">
                          <input class="span8" placeholder="Name" type="text" name="can_name" required />
                        </div>
                    </div>

<!-- Candidate's Position: -->
                    <div class="control-group">
                      <label for="Positions" class="control-label">Positions:</label>
                        <div class="controls">
                          <select class="span8 post" name="position">
                            <option>Select a position</option>
<?php 
                                $query = "select * from tb_positions";
                                $sql = mysqli_query($con, $query);
                                while ($row=mysqli_fetch_array($sql)){
                                $ID = $row['positions_id'];
                                $posts = $row['positions_name'];
                                echo "<option value='$posts'>$posts</option>";    
                                }
?>
                          </select>
                        </div>
                      </div><br>

<!-- Candidate's College: -->
                    <div class="college">
                      <div class="control-group">
                        <label for="College" class="control-label">College:</label>
                          <div class="controls colleges_list">
                          
                          </div>
                        </div>
                        <br>
                        <span class="span4 college-collapse">Add a College</span>
                        <br>
                      </div>

                      <div class="college-collapse-data">
                        <div class="control-group">
                          <div class="controls">
                            <input class="span7 college-name" placeholder="College" type="text" />
                            <button title="Update Profile" type="submit" class="btn add-college" name="add-college">Add</button><br>
                            <div class="message_box"></div>
                          </div>
                        </div>
                      </div>
<br>
<!-- Candidate's Email: -->
                    <div class="control-group">
                      <label for="Email" class="control-label">Candidate's Email:</label>
                        <div class="controls">
                          <input type="email" class="span8" placeholder="Email" name="email" />
                        </div>
                    </div>


<!-- Candidate's Picture: -->
                    <div class="control-group">
                      <label for="Product Image" class="control-label">Candidate's Picture:</label>
                        <div class="controls">
                          <input class="span8" type="file" name="image" />
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


                <!-- Table -->
                        <div class="module">         
                            <div class="module-body">
                              <div id="show_def">
                                <table>
                                    <tr>
                                      <th>S. No.</th>
                                      <th>Name</th>
                                      <th>Position</th>
                                      <th>Email</th>
                                      <th>Votes</th>

                                      <th><button class="btn btn-inverse" id="edit" onclick="editDiv()" style="float: right">Edit <i class="icon-pencil"></i></button></th>
                                    </tr> 
<?php
            
            $q = mysqli_query($con, "SELECT * FROM tb_candidates ORDER BY candidates_position ASC");
            $count = 0;
            while($r = mysqli_fetch_array($q)){
            $count++;
            $can_id = $r['candidates_id'];
            $can_img = $r['candidates_pic'];
            $can_name = $r['candidates_name'];
            $can_pos = $r['candidates_position'];
            $can_email = $r['candidates_email'];
            $can_vote = $r['candidate_cvotes'];
            // $I = 'id_'.$pos_id1;
            // $J = 'l_'.$pos_id1;
?>
                                    <tr>
                                      <td><?=$count?></td>
                                      <td><input type="text" value="<?=$can_name?>" readonly></td>
                                      <td><input type="text" value="<?=$can_pos?>" readonly></td>
                                      <td><input style="width: 140px" type="text" value="<?=$can_email?>" readonly/ ></td>
                                      <td style="text-align: left;"><?=$can_vote?></td>
                                      <td style="width: 170px">
                                        
                                      </td>
                                    </tr>
<?php
            }
?>

                                    
                                  </table><br>

                              </div>
                              <!-- /hide -->

                              <div id="show_after" class="hide">
                                <table>
                                    <tr>
                                      <th>S. No.</th>
                                      <th>Name</th>
                                      <th>Position</th>
                                      <th>Email</th>
                                      <th>Votes</th>

                                      <th><button class="btn btn-inverse" id="edit" onclick="editDiv1()" style="float: right">Cancel <i class="icon-remove-circle"></i></button></th>
                                    </tr> 
<?php
            
            $q1 = mysqli_query($con, "SELECT * FROM tb_candidates ORDER BY candidates_position ASC");
            $count = 0;
            while($r1 = mysqli_fetch_array($q1)){
            $count++;
            $can_id1 = $r1['candidates_id'];
            $can_img1 = $r1['candidates_pic'];
            $can_name1 = $r1['candidates_name'];
            $can_pos1 = $r1['candidates_position'];
            $can_email1 = $r1['candidates_email'];
            $can_vote1 = $r1['candidate_cvotes'];
            $I = 'nam_'.$can_id1;
            $J = 'mail_'.$can_id1;
            $L = 'sel_'.$can_id1;
?>
           
                                    <tr>
                                      <td><?=$count?></td>
                                      <td><input type="text" id="<?=$I?>" value="<?=$can_name1?>"></td>
                                      <td>
                                      <select id="<?=$L?>">
                                        <option value="<?=$can_pos1?>"><?=$can_pos1?></option>
                          <?php
                                $query = "select * from tb_positions";
                                $sql = mysqli_query($con, $query);
                                while ($row=mysqli_fetch_array($sql)){
                                $ID = $row['positions_id'];
                                $posts = $row['positions_name'];
                                echo "<option value='$posts'>$posts</option>";    
                                }
                          ?>           </select>

                                        <!-- <input type="text" value="<?=$can_pos1?>"> -->
                                      </td>
                                      <td><input type="text" id="<?=$J?>" style="width: 140px" value="<?=$can_email1?>"></td>
                                      <td style="text-align: left;"><?=$can_vote1?></td>
                                      <td id="na">
                                        <span class='edit btn btn-info' id='<?php echo 
                                        $can_id1; ?>'>Update <i class="icon-edit"></i></span>&ensp;
                                        <span class='delete btn btn-danger' id='<?php echo $can_id1; ?>'>Delete <i class="icon-remove"></i></span>
                                      </td>
                                    </tr>
<?php
            }
?>
                                    
                                  </table><br> 


                 <!-- <div class="module">
                    <div class="module-head">
                      <h3>Add Candidates</h3>
                    </div>
                 <div class="module-body">
<!--  <div class="alert">
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

    <br />
                
              </div> -->
              <!-- module-body -->
            </div>
            <!-- /module -->
          </div>
          <!-- /show_after -->
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

</body>
<!-- </body> -->
<!-- footer -->
<?php include('../include/footer.html'); ?>
<!-- /footer -->
</html>

<script>


      $(".post").change(function(){
        if($(this).val()=="Court Member")
        {    
            $(".college").show();
        }
          else
          {
              $(".college").hide();
          }
      });

      $(document).ready(function() {
        var delay = 1000;
        $('.add-college').click(function(e){
          e.preventDefault();
          var college_name = $('.college-name').val();
    
            $.ajax({
              type: "POST",
              url: "scripts/add-college.php",
              data: "college="+college_name,
            
              success: function(data){
                setTimeout(function() {
                  $('.message_box').html(data);
                }, delay);
              }
            });
        });

        $.ajax({
          type: "POST",
          url: "scripts/colleges.php",
          success: function(data) {
          var obj = $.parseJSON(data); 
          // var name = data['name'];
          var result = "<select class='span8' name='college'><option value='NULL'>Select College of the Candidate for the Court Member</option>"

          $.each(obj, function() {
              result = result + "<option value='"+this['colleges']+"'>"+this['colleges']+"</option>";
          });
          result = result + "</select>"
          $(".colleges_list").html(result);
          }

        });
      });

    $(document).ready(function(){
      $('.collapsible').click(function(){
        $('.show').toggle(360);
      });
      
      // add college button toggle
      $('.college-collapse').click(function(){
        $('.college-collapse-data').toggle(360);
      });

    // Delete 
    $('.delete').click(function(){
        var el = this;

        // Delete id
        var id = this.id;
        // alert(id);
        
        // AJAX Request
        $.ajax({
            url: 'update/candidate_update.php',
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


    $(document).ready(function(){
        $('.edit').click(function(){
            var id = this.id;
            var name = $('#nam_'+id).val();
            var pos = $('#sel_'+id).val();
            var mail = $('#mail_'+id).val();
            // alert (id+' '+name+' '+mail+' '+info+' '+pos);

            $.ajax({
                url: 'update/candidate_update.php',
                type: 'POST',
                data: 'id1='+id+'&name='+name+'&pos='+pos+'&mail='+mail,

            success: function(response){

                if(response == 1){
                    // Remove row from HTML Table
                    // setTimeout(location.reload.bind(location), 1000);
                    $('.al').html(
                      '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong style="font-size:20px">Updated!</strong><br><br><a href="upload" class="btn btn-info">Reload Page <i class="icon-repeat"></i></a>&ensp;&ensp;&ensp;<button type="button" class="btn btn-info" data-dismiss="alert">Cancle <i class="icon-remove"></i></button></div>'
                      );
                }else{
                    alert('Invalid ID.');
                }
            }
            });
        });
    });


</script>