<?php

require_once '../database/db_connection.php';
session_start();

if(isset($_SESSION['admin_name'])){
	header('location:dashboard.php');
	exit();
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(empty($username) || empty($password)){
		echo("<script>alert('Please enter username and password!')</script>");
	}else{
	    $sql = "SELECT * FROM admin WHERE name = '$username' AND password= '$password'";
		$query = $con->query($sql);
		
		//check user exist or not.
		if($query->num_rows > 0){
		    $result = $query->fetch_array();
		    $_SESSION['admin_name'] = $result['name'];
		 	header('location:dashboard.php');
			exit();
		}else{
		    echo "<script>
            alert('Wrong username or password!');
            window.location.href='index.php';
            </script>";
		}
	}
}






?>