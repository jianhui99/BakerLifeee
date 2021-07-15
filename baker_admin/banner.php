<?php

//check connect
require_once '../database/db_connection.php';

session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

if(isset($_GET['page'])){
    if($_GET['page'] <= 0 || !is_numeric($_GET['page'])){
        $offset = 0;
    }else{
        $offset = ($_GET['page'] - 1);
    }
}else{
    $offset = 0;
}

$limit = 5;
$skip = $limit * $offset;

$query = "select * from banner limit $skip, $limit";
$result = mysqli_query($con, $query);

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
    <h3 class="mt-3">Banner Lists</h3>
    <a href="addBanner.php" class='btn btn-success mb-3 float-right'>+ Add banner</a>
    
    <table class="table table-striped">
        <tr>
            <td> No</td>
            <td> Title</td>
            <td> Image</td>
            <td> Description</td>
            <td> Set Default</td>
            <td> Status</td>
            <td> Action</td>
        </tr>
        <tr>
            <?php
                while($row=mysqli_fetch_assoc($result)){

            ?>
                <td><?=$row['id']?></td>
                <td><?= $row['title']?></td>
                <td><img src="..\images\Banner\<?=$row['image']?>" width="80px"></td>
                <td  class="w-25"><?= $row['description']?></td>
                <td><?php 
                    if($row['set_default'] == '0'){
                        echo('No');
                    }elseif($row['set_default'] == '1'){
                        echo('Yes');
                    }else {
                        echo('-');
                    }
                ?></td>
                <td><?php 
                    if($row['status'] == '0'){
                        echo('Disabled');
                    }elseif($row['status'] == '1'){
                        echo('Enabled');
                    }else {
                        echo('-');
                    }
                ?></td>
                <td>
                    <a href="addBanner.php?editBanner=<?= $row['id']?>"  class='btn btn-primary'>Edit</a>
                    <a href="deleteBanner.php?deleteBanner=<?= $row['id']?>" class='btn btn-danger'>Delete</a>
                </td>
        </tr>
        <?php } ?>
    </table>
    
    <?php
        $pr_query = "select * from banner";
        $pr_result = mysqli_query($con, $pr_query);
        $total_record = mysqli_num_rows($pr_result);
        $total_pages = ceil($total_record/$limit);

        if($offset > 0){
            $offset += 1;
            echo("<a href='banner.php?page=".($offset-1)."' class='btn btn-info' style='margin-right: 5px;'>Previous</a>");
        }

        for($i=1; $i<=$total_pages;$i++){
            echo("<a href='banner.php?page=".$i."' class='btn btn-primary' style='margin-right: 3px;'>$i</a>");
        }
    ?>
  </div>
</body>
</html>
