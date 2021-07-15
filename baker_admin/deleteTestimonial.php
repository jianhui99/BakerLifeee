<?php

//check connect
require_once '../database/db_connection.php';

session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

if(isset($_GET['deleteTestimonial'])){
    $pid = $_GET['deleteTestimonial'];
    $sql = "SELECT * FROM testimonial WHERE id = '$pid'";
    $query = $con->query($sql);
    $result = $query->fetch_array();
    $image = $result['image'];
    $filename = "../images/Testimonial/$image";

    if (file_exists($filename)) {
        unlink($filename);
    }

    $delete_sql = "DELETE FROM testimonial WHERE id='$pid'";
    $delete_query = $con->query($delete_sql);
    
    if(mysqli_affected_rows($con) > 0){
        echo "<script>
        alert('Testimonial has been remove successfully.');
        window.location.href='testimonial.php';
        </script>";
    }
}
?>