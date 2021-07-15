<?php

//check connect
require_once '../database/db_connection.php';

session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

if(isset($_GET['editTestimonial'])){ 
    $testimonial_id = $_GET['editTestimonial'];
    $edit_sql = "SELECT * FROM testimonial WHERE id = '$testimonial_id'";
    $edit_query = $con->query($edit_sql);
    $result = $edit_query->fetch_array();
}

if(isset($_POST['addTestimonial'])){
    $testimonial_title = $_POST['testimonial_title'];
    $testimonial_desc = $_POST['testimonial_desc'];
    $testimonial_status = $_POST['testimonial_status'];
    $testimonial_image = $_FILES['testimonial_image']['name'];
    $target = "../images/testimonial/".basename($testimonial_image);

    $insert_sql = "insert into testimonial(title,image,description,status) values('$testimonial_title', '$testimonial_image', '$testimonial_desc' ,'$testimonial_status')";
    $insert_query = $con->query($insert_sql);
    if(mysqli_affected_rows($con) > 0){
        if($testimonial_image != ""){
            move_uploaded_file($_FILES["testimonial_image"]["tmp_name"], $target);
        }
        echo "<script>
        alert('Testimonial has been added successfully.');
        window.location.href='testimonial.php';
        </script>";
    }else{
        echo(mysqli_error($con));
    }
}

if(isset($_POST['updateTestimonial'])){
    
    $testimonial_id = $_POST['testimonial_id'];
    $testimonial_title = $_POST['testimonial_title'];
    $testimonial_desc = $_POST['testimonial_desc'];
    $set_default = $_POST['set_default'];
    $testimonial_status = $_POST['testimonial_status'];
    $testimonial_image = $_FILES['testimonial_image']['name'];
    $disable_other = false;

    if($testimonial_image != ''){
        $target = "../images/testimonial/".basename($testimonial_image);
    }else{
        $get_image = "SELECT * FROM testimonial WHERE id = '$testimonial_id'";
        $get_image_query = $con->query($get_image);
        $get_image_result = $get_image_query->fetch_array();
        $testimonial_image = $get_image_result['image'];
        $target = "../images/testimonial/".basename($testimonial_image);
    }

    if($set_default == '1'){
        $disable_other = true;
    }

    $update_sql = "update testimonial set title = '$testimonial_title', image = '$testimonial_image', description='$testimonial_desc' , set_default='$set_default' ,status = '$testimonial_status' where id = '$testimonial_id'";
    $update_query = $con->query($update_sql);
    if(mysqli_affected_rows($con) > 0){
        if($testimonial_image != ""){
            move_uploaded_file($_FILES["testimonial_image"]["tmp_name"], $target);
        }

        if($disable_other){
            $update_disable_other = "update testimonial set set_default= 0 where id != '$testimonial_id'";
            $con->query($update_disable_other);
        }

        echo "<script>
        alert('Testimonial has been updated successfully.');
        window.location.href='testimonial.php';
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
    if(isset($_GET['editTestimonial'])){ ?>
        <h3 class="mt-3">Edit testimonial</h3>
        <div class="p-3 mb-2 bg-light text-dark">
            <form action="addTestimonial.php" method="POST" enctype="multipart/form-data">
                <label for="testimonial_title">Testimonial Title</label>
                <input type="text" name="testimonial_title" class="form-control mb-2" placeholder="Enter testimonial name" required value="<?php if(isset($result['title'])) echo($result['title']) ?>">
                <label for="testimonial_image">Testimonial Image</label> <br>
                <img src="..\images\Testimonial\<?=$result['image']?>" width="80px" class="m-3">
                <input type="file" name="testimonial_image" id="testimonial_image" class="form-control mb-2" value="<?php if(isset($result['image'])) echo($result['image']) ?>">
                <label for="testimonial_desc">Testimonial Description</label>
                <textarea name="testimonial_desc" id="testimonial_desc" cols="10" rows="5" placeholder="Enter testimonial description" class="form-control mb-2"><?php if(isset($result['description'])) echo($result['description']) ?></textarea>
                
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

                <label for="testimonial_status">Testimonial Status</label>
                <select name="testimonial_status" class="form-control mb-2" >
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
                <input type="hidden" name="testimonial_id" value="<?=$_GET['editTestimonial']?>">
                <input type="submit" name="updateTestimonial" class="form-control btn btn-primary mt-2" value="Edit testimonial" required>
            </form>
        </div>
    <?php }else { ?>
        <h3 class="mt-3">Add New Testimonial</h3>
        <div class="p-3 mb-2 bg-light text-dark">
            <form action="addTestimonial.php" method="POST" enctype="multipart/form-data">
                <label for="testimonial_title">Testimonial Title</label>
                <input type="text" name="testimonial_title" class="form-control mb-2" placeholder="Enter testimonial title" required value="<?php if(isset($result['title'])) echo($result['title']) ?>">
                <label for="testimonial_image">Testimonial Image</label>
                <input type="file" name="testimonial_image" id="testimonial_image" class="form-control mb-2" value="<?php if(isset($result['image'])) echo($result['image']) ?>">
                <label for="testimonial_desc">Testimonial Description</label>
                <textarea name="testimonial_desc" id="testimonial_desc" cols="10" rows="5" placeholder="Enter testimonial description" class="form-control mb-2"><?php if(isset($result['description'])) echo($result['description']) ?></textarea>
        
                <label for="testimonial_status">Testimonial Status</label>
                <select name="testimonial_status" class="form-control mb-2" >
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
                <input type="submit" name="addTestimonial" class="form-control btn btn-primary mt-2" value="Add testimonial" required>
            </form>
        </div>
    <?php } ?>                   
  </div>
</body>
</html>