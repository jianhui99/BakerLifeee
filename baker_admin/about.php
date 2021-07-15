<?php

//check connect
require_once '../database/db_connection.php';

session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

$sql = "select * from about";
$query = $con->query($sql);
$result = $query->fetch_array();

$disabled = "disabled";
$enabled = "enabled";
$none = "none";
$block = "block";

if(isset($_POST['editAbout'])){
    $block = "none";
    $none = "block";
    $disabled = "enabled";
    $enabled = "disabled";
}

if(isset($_POST['saveAbout'])){
    $block = "block";
    $none = "none";
    $disabled = "disabled";
    $enabled = "enabled";

    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    if($image != ''){
        $old_image = $result['image'];
        $filename = "../images/About/$old_image";
        if (file_exists($filename)) {
            unlink($filename);
        }
        
        $target = "../images/About/".basename($image);
    }else{
        $get_image = "SELECT * FROM about WHERE id = 1";
        $get_image_query = $con->query($get_image);
        $get_image_result = $get_image_query->fetch_array();
        $image = $get_image_result['image'];
        $target = "../images/About/".basename($image);
    }

    $update_sql = "update about set content = '$content', image = '$image' where id = 1";
    $update_query = $con->query($update_sql);
    if(mysqli_affected_rows($con) > 0){
        if($image != ""){
            move_uploaded_file($_FILES["image"]["tmp_name"], $target);
        }
        echo "<script>
        alert('About content has been updated successfully.');
        window.location.href='about.php';
        </script>";
    }else{
        echo(mysqli_error($con));
    }
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- bootstrap core css -->
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
<title>BakerAdmin Dashboard</title>
</head>

<body>

  <?php require_once 'navbar.php'; ?>
  <div class="container mb-5">
  <h3 class="mt-3">About Us</h3>
  <hr>
  <form action="about.php" method="post" enctype="multipart/form-data">
    <div class="row">
            <div class="col-md-3">
                <img src="..\images\About\<?= $result['image'] ?>" width="220px">
                <input type="file" name="image" class="form-control mt-2" style="display:<?= $none?>;">
            </div>
            <div class="col-md-9">
                <textarea name="content" cols="10" rows="5" class="form-control" <?= $disabled?>><?= $result['content'] ?></textarea>

                <button name="editAbout" class="form-control btn btn-info mt-5" style="display:<?= $block?>;">Edit about</button>
                <button name="saveAbout" class="form-control btn btn-success mt-5" style="display:<?= $none?>;">Save about</button>
            </div>  
        </div>
    </form>
  </div>
</body>
</html>
