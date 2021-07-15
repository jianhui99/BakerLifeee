<?php

//check connect
require_once '../database/db_connection.php';

session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

if(isset($_GET['editProduct'])){ 
    $product_id = $_GET['editProduct'];
    $edit_sql = "SELECT * FROM product WHERE id = '$product_id'";
    $edit_query = $con->query($edit_sql);
    $result = $edit_query->fetch_array();
}

if(isset($_POST['addProduct'])){
    $product_name = $_POST['product_name'];
    $product_status = $_POST['product_status'];
    $product_image = $_FILES['product_image']['name'];
    $target = "../images/Product/".basename($product_image);

    $insert_sql = "insert into product(name,image,status) values('$product_name', '$product_image', '$product_status')";
    $insert_query = $con->query($insert_sql);
    if(mysqli_affected_rows($con) > 0){
        if($product_image != ""){
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $target);
        }
        echo "<script>
        alert('Product has been added successfully.');
        window.location.href='product.php';
        </script>";
    }else{
        echo(mysqli_error($con));
    }
}

if(isset($_POST['updateProduct'])){
    
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_status = $_POST['product_status'];
    $product_image = $_FILES['product_image']['name'];
    if($product_image != ''){
        $target = "../images/Product/".basename($product_image);
    }else{
        $get_image = "SELECT * FROM product WHERE id = '$product_id'";
        $get_image_query = $con->query($get_image);
        $get_image_result = $get_image_query->fetch_array();
        $product_image = $get_image_result['image'];
        $target = "../images/Product/".basename($product_image);
    }

    $update_sql = "update product set name = '$product_name', image = '$product_image', status = '$product_status' where id = '$product_id'";
    $update_query = $con->query($update_sql);
    if(mysqli_affected_rows($con) > 0){
        if($product_image != ""){
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $target);
        }
        echo "<script>
        alert('Product has been updated successfully.');
        window.location.href='product.php';
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
    if(isset($_GET['editProduct'])){ ?>
        <h3 class="mt-3">Edit Product</h3>
        <div class="p-3 mb-2 bg-light text-dark">
            <form action="addProduct.php" method="POST" enctype="multipart/form-data">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control mb-2" placeholder="Enter product name" required value="<?php if(isset($result['name'])) echo($result['name']) ?>">
                <label for="product_image">Product Image</label> <br>
                <img src="..\images\Product\<?=$result['image']?>" width="80px" class="m-3">
                <input type="file" name="product_image" id="product_image" class="form-control mb-2" value="<?php if(isset($result['image'])) echo($result['image']) ?>">
                <label for="product_status">Product Status</label>
                <select name="product_status" class="form-control mb-2" >
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
                <input type="hidden" name="product_id" value="<?=$_GET['editProduct']?>">
                <input type="submit" name="updateProduct" class="form-control btn btn-primary mt-2" value="Edit product" required>
            </form>
        </div>
    <?php }else { ?>
        <h3 class="mt-3">Add New Product</h3>
        <div class="p-3 mb-2 bg-light text-dark">
            <form action="addProduct.php" method="POST" enctype="multipart/form-data">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control mb-2" placeholder="Enter product name" required value="<?php if(isset($result['name'])) echo($result['name']) ?>">
                <label for="product_image">Product Image</label>
                <input type="file" name="product_image" id="product_image" class="form-control mb-2" value="<?php if(isset($result['image'])) echo($result['image']) ?>">
                <label for="product_status">Product Status</label>
                <select name="product_status" class="form-control mb-2" >
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
                <input type="submit" name="addProduct" class="form-control btn btn-primary mt-2" value="Add product" required>
            </form>
        </div>
    <?php } ?>                   
  </div>
</body>
</html>