<?php

session_start();
ob_start();

$username = $_SESSION['username'];
if(!isset($username)){
  header('Location: login/confirmation');
}

if(isset($_POST['submit']) OR isset($_POST['add'])){

@$ip1 = $_POST['ip1'].'.'.$_POST['ip2'].'.'.$_POST['ip3'].'.'.$_POST['ip4'];
@$ip2 = $_SERVER['REMOTE_ADDR'];

if(isset($_POST['submit']))
    $ip = $ip1;
else
    $ip = $ip2;


$arr = file('../.htaccess');
$f = fopen("../.htaccess", "a+");

    $file = file("../.htaccess");
    $readLines = max(0, count($file)-1); //n being non-zero positive integer
    echo $readLines+1;
    $last = $file[$readLines];
    if($last == "\n"){
        // empty line.
        fwrite($f, "allow from ".$ip);
    }else{
        // non-empty line here
        fwrite($f, "\nallow from ".$ip);
    }

fclose($f);
header('Location:access.php');

}

if(isset($_GET['ip'])){

$remove = $_GET['ip'];
$file1 = fopen("../.htaccess", "r") or exit("Unable to openfile!");
$t="";
while(!feof($file1)){
  $k= fgets($file1);
  if ( (preg_match("/$remove/", $k)) ){
  }else{
   $t=$t.$k; 
  }
}
 
fclose($file1);
$file = fopen("../.htaccess", "w") or exit("Unable to open file!");
fwrite($file,$t);
fclose($file);
header('Location:access');

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php");  ?>
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

                        <!-- Start Any Page From Here -->
<hr style="border:1px solid pink">
                        <center>
<form method="POST">
    <div class="form-control">
        <input type="text" name="ip1" style="width: 60px" maxlength="3" required=""> .
        <input type="text" name="ip2" style="width: 60px" maxlength="3" required=""> .
        <input type="text" name="ip3" style="width: 60px" maxlength="3" required=""> .
        <input type="text" name="ip4" style="width: 60px" maxlength="3" required=""><br>
        <input type="submit" class="btn btn-info" name="submit" value="Enter  IP" style="width: 326px;color: black;">
    </div>
</form>
OR
<br>
<form  method="POST">
<input type="submit" class="btn btn-primary" name="add" value="Allow From This PC" style="width: 326px;color: #fff;font-weight: bolder;">
</form>
<br>
<?=$_SERVER['REMOTE_ADDR'];?>
<br><hr style="border:1.4px solid pink">
<h3>Allowed IPs</h3><br>

<?php

$fp = fopen("../.htaccess", "r");
$array = iterator_to_array(slice($fp, 10, 99999));

foreach($array as $key => $value) { 
    if ( (preg_match("/allow from/", $value)) ){
        echo '
        <div style="width:326px">
            <a type="button" class="btn btn-info" href="access?ip='.$value.'" style="float:right">Remove</a>&ensp;
            <b style="font-size:17px;float:left;">'.$value.'</b><br><br>
        </div>
        ';
    } else {}
}

fclose($fp);

function slice($fp, $offset = 0, $length = 0) {
    $i = 0;
    while (false !== ($row = fgets($fp))) {
        if ($i++ < $offset) continue;
        if (0 < $length && $length <= ($i - $offset - 1)) break;
        yield $row;
    }
}

?>
                       </center>
<!-- End Any Page Here -->
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
