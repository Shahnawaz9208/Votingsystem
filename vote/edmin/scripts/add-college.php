<?php
@session_start();
ob_start();
include '../../include/db.php';

$college = $_POST['college'];
$sql = "INSERT INTO `tb_colleges`(colleges) VALUES ('$college')";
$query = mysqli_query($con, $sql);
if($query){
       echo "College Added";
?>
       <script>
            $(document).ready(function() {
                $.ajax({
                type: "POST",
                url: "scripts/colleges.php",
                success: function(data) {
                var obj = $.parseJSON(data); 
                // var name = data['name'];
                var result = "<select class='span8' name='position'><option value='college'>Select College of the Candidate for the Court Member</option>"

                $.each(obj, function() {
                    result = result + "<option value='"+this['college_id']+"'>"+this['colleges']+"</option>"; 
                });
                result = result + "</select>"
                $(".colleges_list").html(result);
                alert('New College Added');
                }
                });
            });
       </script>
       
<?php
}