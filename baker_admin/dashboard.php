<?php

//check connect
require_once '../database/db_connection.php';
session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

$visitors = "select * from visitor";
$visitors_result = $con->query($visitors);
$total_visitor = $visitors_result->num_rows;

$prducts = "select * from product";
$products_result = $con->query($prducts);
$total_product = $products_result->num_rows;

$banner = "select * from banner";
$banners_result = $con->query($banner);
$total_banner = $banners_result->num_rows;

$testimonials = "select * from testimonial";
$testimonials_result = $con->query($testimonials);
$total_testimonial = $testimonials_result->num_rows;


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
    <a href="home.php" class="btn btn-success mt-3">Home</a>
    <a href="banner.php" class="btn btn-warning mt-3">Banner</a>
    <a href="about.php" class="btn btn-info mt-3">About</a>
    <a href="product.php" class="btn btn-primary mt-3">Product</a>
    <a href="testimonial.php" class="btn btn-dark mt-3">Testimonial</a>
    <a href="https://api.whatsapp.com/send?phone=60167649725" class="btn btn-secondary mt-3" target="_blank">Contact Support</a>
    
    <hr>
    
    <h4>Total Product: <?= $total_product ?></h4> <br>
    <h4>Total Banner: <?= $total_banner ?></h4> <br>
    <h4>Total Testimonial: <?= $total_testimonial ?></h4> <br>
    <h4>Total Visitor: <?= $total_visitor ?></h4>
    
  </div>
</body>
</html>
