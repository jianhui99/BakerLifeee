<?php

//check connect
require_once '../database/db_connection.php';

session_start();

if(empty($_SESSION['admin_name'])){
	header('location:index');
	exit();
}
$admin_name = $_SESSION['admin_name'];

if(isset($_GET['deleteProduct'])){
    $pid = $_GET['deleteProduct'];
    $sql = "SELECT * FROM product WHERE id = '$pid'";
    $query = $con->query($sql);
    $result = $query->fetch_array();
    $image = $result['image'];
    $filename = "../images/Product/$image";

    if (file_exists($filename)) {
        unlink($filename);
    }

    $delete_sql = "DELETE FROM product WHERE id='$pid'";
    $delete_query = $con->query($delete_sql);
    
    if(mysqli_affected_rows($con) > 0){
        echo "<script>
        alert('Product has been remove successfully.');
        window.location.href='product.php';
        </script>";
    }
}
?>