<?php
include('../include/db.php');
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

$r_max = mysqli_fetch_array(mysqli_query($con, "SELECT positions_limit FROM tb_positions where positions_name = 'Cabinet'"));
$limit = $r_max['positions_limit'];       
     
if(isset($_POST['insert'])){
    $query = "select positions_id from tb_positions ORDER BY positions_id DESC LIMIT 1";
    $sql = mysqli_query($con, $query);
    $row=mysqli_fetch_array($sql);
    $ID = $row['positions_id'];
    $id = $ID + 1;
    
    $post = $_POST['postname'];
    $max = $_POST['max_l'];
    $sqladd = "INSERT into tb_positions (positions_id, positions_name, positions_limit) VALUES ('$id', '$post', '$max')";
    $result = mysqli_query($con, $sqladd);
    if($result){
    echo  "<script>window.open('position','_self');</script>";
    }
}
$r_ma = mysqli_fetch_array(mysqli_query($con, "SELECT positions_limit FROM tb_positions where positions_name = 'Cabinet'"));
$limit = $r_ma['positions_limit'];
?>
<!DOCTYPE html>
<html lang="en" style="overflow:auto;">

<head>
    <?php include('head.php');  ?>
    <style>
        ::-webkit-scrollbar { width: 0 !important }
        #max{
            display: none;
        }
        table {
          /*border-collapse: collapse;*/
          /*width: 100%;*/
        }

        th{
          padding: 10px;
          text-align: left;
        }
        td{
          padding: 10px;
          text-align: left;
          border-bottom: 1px solid #ddd;
        }
        #na {
            position: relative;
            left: 10px;
            border-bottom: none;
        }

        tr:hover {background-color:#f5f5f5;}

        #show_after{
            display: none;
        }
        .delete:hover{
            cursor: pointer;
            color: #c1c1c1;
        }
        .edit:hover{
            cursor: pointer;
            color: #000;
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
                        <div class="al"></div>


                <!-- Table -->
                        <div class="module">         
                            <div class="module-body">
                              <div id="show_def">
                                <table>
                                    <tr>
                                      <th>S. No.</th>
                                      <th>Position Name</th>
                                      <th><button class="btn btn-inverse" id="edit" onclick="editDiv()" style="float: right;">Edit</button></th>
                                    </tr> 
<?php
            
            $q = mysqli_query($con, "SELECT * FROM tb_positions ORDER BY positions_id ASC");
            $count = 0;
            while($r = mysqli_fetch_array($q)){
            $count++;
            $pos_id = $r['positions_id'];
            $pos_name = $r['positions_name'];
            echo'
                                    <tr>
                                      <td>'.$count.'</td>
                                      <td>
                                      <input type="text" value="'.$pos_name.'" readonly>
                                      &ensp;
                ';
            if($pos_name == 'Cabinet'){

            echo'           <b>Limit:&ensp;</b> <input type="text" value="'.$limit.'" readonly>  ';
                }
?>
                                      </td>

                                      <td style="width: 170px">
                                          
                                      </td>
                                    </tr>
<?php
            }
?>
                                    
                                  </table><br>

                              </div>
             
                             <!-- /hide -->

                              <div id="show_after">
                                <table>
                                    <tr>
                                      <th>S. No.</th>
                                      <th>Position Name</th>
                                      <th><button class="btn btn-inverse" onclick="editDiv1()" style="float: right">Cancel</button></th>
                                    </tr> 
<?php
            
            $q1 = mysqli_query($con, "SELECT * FROM tb_positions ORDER BY positions_id ASC");
            $count = 0;
            while($r1 = mysqli_fetch_array($q1)){
            $count++;
            $pos_id1 = $r1['positions_id'];
            $pos_name1 = $r1['positions_name'];
            $I = 'id_'.$pos_id1;
            $J = 'l_'.$pos_id1;
            echo'
                                    <tr>
                                      <td>'.$count.'</td>
                                      <td>
                                      <input type="text" id="'.$I.'" value="'.$pos_name1.'">&ensp;
                ';
            if($pos_name1 == 'Cabinet'){

            echo'                 <b>Limit:&ensp;</b> <input id="'.$J.'" type="text" value="'.$limit.'">  ';
                }
?>
                                    </td>
                                      <td id="na">
                                        <span class='edit btn btn-info' id='<?php echo 
                                        $pos_id1; ?>'>Update <i class="icon-edit"></i></span>&ensp;
                                        <span class='delete btn btn-danger' id='<?php echo $pos_id; ?>'>Delete <i class="icon-remove"></i></span>
                                      </td>
                                    </tr>
<?php
            }
?>
                                    
                                  </table><br>  

                                  <div class="module">
                                    <div class="module-head">
                                        <h3>Add Position</h3>
                                    </div>
                                    <div class="module-body">

        <form class="form-horizontal row-fluid" method="POST" action="" enctype="multipart/form-data">
<!-- Position Name: -->
                                            <div class="control-group">
                                                <label for="Post Name" class="control-label">Post Name:</label>

                                                <div class="controls">
                                                    <input class="span10" placeholder="Enter the post name" type="text" id="input" name="postname" onkeyup="showDiv()" required />
                                                </div>
                                            </div><br>


                                            <div id="max">
                                              <div class="control-group">
                                                <label for="Max" class="control-label">Limit:</label>
                                                  <div class="controls">
                                                    <input class="span10" placeholder="Limit for maximum number of Cabinets to be voted. e.g, 10" type="number" name="max_l">
                                                  </div>
                                              </div> <br>
                                            </div>


                                            <!-- Add Button -->
                                            <div class="control-group">
                                                <div class="controls">
                                                    <button title="Add Position" type="submit" class="btn btn-primary span10" name="insert">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- module-body -->
                                </div>
                                <!-- /module -->
                                </div>
                                <!-- /show_after -->
                            </div>
                            <!-- module-body -->
                        </div>
                        <!-- /module -->

                        

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
    <!-- footer -->
<?php include('../include/footer.html'); ?>
</html>

<script>
    $(document).ready(function(){

    // Delete 
    $('.delete').click(function(){
        var el = this;

        // Delete id
        var id = this.id;
        
        // AJAX Request
        $.ajax({
            url: 'update/position_update.php',
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

            var pos = $('#id_'+id).val();

            if(pos == 'Cabinet'){
                var limit = $('#l_'+id).val();

            }

            $.ajax({
                url: 'update/position_update.php',
                type: 'POST',
                data: 'id1='+id+'&pos='+pos+'&max_ca='+limit,

            success: function(response){

                if(response == 1){
                    // Remove row from HTML Table
                    // setTimeout(location.reload.bind(location), 1000);
                    $('.al').html(
                      '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong style="font-size:20px">Updated!</strong><br><br><a href="position" class="btn btn-info">Reload Page <i class="icon-repeat"></i></a>&ensp;&ensp;&ensp;<button type="button" class="btn btn-info" data-dismiss="alert">Cancle <i class="icon-remove"></i></button></div>'
                      );
                }else{
                    alert('Invalid ID.');
                }
            }
            });
        });
    });
</script>