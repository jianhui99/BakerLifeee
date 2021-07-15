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

$query = "select * from testimonial limit $skip, $limit";
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

  </div>
</body>
</html>
