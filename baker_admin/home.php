<?php

//check connect
require_once '../database/db_connection.php';

session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

$check = "select * from visitor";
$check_result = $con->query($check);

$total = $check_result->num_rows;

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

$query = "select * from visitor limit $skip, $limit";
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
    <div class="container">
        <h4 class="mt-3">
            Total visitor on your website: <?= $total ?>
        </h4>
        
        <table class="table table-striped mt-2">
        <tr>
            <td> No</td>
            <td> IP-Address</td>
            <td> Action</td>
        </tr>
        <tr>
            <?php
                while($row=mysqli_fetch_assoc($result)){

            ?>
                <td class="w-25"><?=$row['id']?></td>
                <td class="w-50"><?= $row['ip_address']?></td>
                <td class="w-25">
                    <a href="https://whatismyipaddress.com/ip/<?= $row['ip_address']?>" class='btn btn-info mb-3' target='_blank'>Check Location</a>
                </td>
        </tr>
        <?php } ?>
    </table>
    
    <?php
        $pr_query = "select * from visitor";
        $pr_result = mysqli_query($con, $pr_query);
        $total_record = mysqli_num_rows($pr_result);
        $total_pages = ceil($total_record/$limit);

        if($offset > 0){
            $offset += 1;
            echo("<a href='home.php?page=".($offset-1)."' class='btn btn-info' style='margin-right: 5px;'>Previous</a>");
        }

        for($i=1; $i<=$total_pages;$i++){
            echo("<a href='home.php?page=".$i."' class='btn btn-primary' style='margin-right: 3px;'>$i</a>");
        }
    ?>
    </div>

  </div>
</body>
</html>
