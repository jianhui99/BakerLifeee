<?php

//check connect
require_once '../database/db_connection.php';
session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];
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

  </div>
</body>
</html>
