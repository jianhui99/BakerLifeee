<?php

//check connect
require_once '../database/db_connection.php';

session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

if(isset($_GET['editBanner'])){ 
    $banner_id = $_GET['editBanner'];
    $edit_sql = "SELECT * FROM banner WHERE id = '$banner_id'";
    $edit_query = $con->query($edit_sql);
    $result = $edit_query->fetch_array();
}

if(isset($_POST['addBanner'])){
    $banner_title = $_POST['banner_title'];
    $banner_desc = $_POST['banner_desc'];
    $banner_status = $_POST['banner_status'];
    $banner_image = $_FILES['banner_image']['name'];
    $target = "../images/banner/".basename($banner_image);

    $insert_sql = "insert into banner(title,image,description,status) values('$banner_title', '$banner_image', '$banner_desc' ,'$banner_status')";
    $insert_query = $con->query($insert_sql);
    if(mysqli_affected_rows($con) > 0){
        if($banner_image != ""){
            move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target);
        }
        echo "<script>
        alert('Banner has been added successfully.');
        window.location.href='banner.php';
        </script>";
    }else{
        echo(mysqli_error($con));
    }
}

if(isset($_POST['updatebanner'])){
    
    $banner_id = $_POST['banner_id'];
    $banner_title = $_POST['banner_title'];
    $banner_desc = $_POST['banner_desc'];
    $set_default = $_POST['set_default'];
    $banner_status = $_POST['banner_status'];
    $banner_image = $_FILES['banner_image']['name'];
    $disable_other = false;

    if($banner_image != ''){
        $target = "../images/banner/".basename($banner_image);
    }else{
        $get_image = "SELECT * FROM banner WHERE id = '$banner_id'";
        $get_image_query = $con->query($get_image);
        $get_image_result = $get_image_query->fetch_array();
        $banner_image = $get_image_result['image'];
        $target = "../images/banner/".basename($banner_image);
    }

    if($set_default == '1'){
        $disable_other = true;
    }

    $update_sql = "update banner set title = '$banner_title', image = '$banner_image', description='$banner_desc' , set_default='$set_default' ,status = '$banner_status' where id = '$banner_id'";
    $update_query = $con->query($update_sql);
    if(mysqli_affected_rows($con) > 0){
        if($banner_image != ""){
            move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target);
        }

        if($disable_other){
            $update_disable_other = "update banner set set_default= 0 where id != '$banner_id'";
            $con->query($update_disable_other);
        }

        echo "<script>
        alert('Banner has been updated successfully.');
        window.location.href='banner.php';
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
  <div class="container">
    <?php 
    if(isset($_GET['editBanner'])){ ?>
        <h3 class="mt-3">Edit banner</h3>
        <div class="p-3 mb-2 bg-light text-dark">
            <form action="addBanner.php" method="POST" enctype="multipart/form-data">
                <label for="banner_title">Banner Title</label>
                <input type="text" name="banner_title" class="form-control mb-2" placeholder="Enter banner name" required value="<?php if(isset($result['title'])) echo($result['title']) ?>">
                <label for="banner_image">Banner Image</label> <br>
                <img src="..\images\Banner\<?=$result['image']?>" width="80px" class="m-3">
                <input type="file" name="banner_image" id="banner_image" class="form-control mb-2" value="<?php if(isset($result['image'])) echo($result['image']) ?>">
                <label for="banner_desc">Banner Description</label>
                <textarea name="banner_desc" id="banner_desc" cols="10" rows="5" placeholder="Enter banner description" class="form-control mb-2"><?php if(isset($result['description'])) echo($result['description']) ?></textarea>
                
                <label for="set_default">Set Default</label>
                <select name="set_default" class="form-control mb-2" >
                    <?php if(isset($result['set_default'])){
                        if($result['set_default'] == '0'){ ?>
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        <?php }else { ?>
                            <option value="0">No</option>
                            <option value="1" selected>Yes</option>
                        <?php } ?>
                    <?php }else{ ?>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    <?php } ?>
                </select>

                <label for="banner_status">Banner Status</label>
                <select name="banner_status" class="form-control mb-2" >
                    <?php if(isset($result['status'])){
                        if($result['status'] == '0'){ ?>
                            <option value="0" selected>Disabled</option>
                            <option value="1">Enabled</option>
                        <?php }else { ?>
                            <option value="0">Disabled</option>
                            <option value="1" selected>Enabled</option>
                        <?php } ?>
                    <?php }else{ ?>
                        <option value="0">Disabled</option>
                        <option value="1">Enabled</option>
                    <?php } ?>
                </select>
                <input type="hidden" name="banner_id" value="<?=$_GET['editBanner']?>">
                <input type="submit" name="updatebanner" class="form-control btn btn-primary mt-2" value="Edit banner" required>
            </form>
        </div>
    <?php }else { ?>
        <h3 class="mt-3">Add New Banner</h3>
        <div class="p-3 mb-2 bg-light text-dark">
            <form action="addBanner.php" method="POST" enctype="multipart/form-data">
                <label for="banner_title">Banner Title</label>
                <input type="text" name="banner_title" class="form-control mb-2" placeholder="Enter banner title" required value="<?php if(isset($result['title'])) echo($result['title']) ?>">
                <label for="banner_image">Banner Image</label>
                <input type="file" name="banner_image" id="banner_image" class="form-control mb-2" value="<?php if(isset($result['image'])) echo($result['image']) ?>">
                <label for="banner_desc">Banner Description</label>
                <textarea name="banner_desc" id="banner_desc" cols="10" rows="5" placeholder="Enter banner description" class="form-control mb-2"><?php if(isset($result['description'])) echo($result['description']) ?></textarea>
        
                <label for="banner_status">Banner Status</label>
                <select name="banner_status" class="form-control mb-2" >
                    <?php if(isset($result['status'])){
                        if($result['status'] == '0'){ ?>
                            <option value="0" selected>Disabled</option>
                            <option value="1">Enabled</option>
                        <?php }else { ?>
                            <option value="0">Disabled</option>
                            <option value="1" selected>Enabled</option>
                        <?php } ?>
                    <?php }else{ ?>
                        <option value="0">Disabled</option>
                        <option value="1">Enabled</option>
                    <?php } ?>
                </select>
                <input type="submit" name="addBanner" class="form-control btn btn-primary mt-2" value="Add banner" required>
            </form>
        </div>
    <?php } ?>                   
  </div>
</body>
</html>