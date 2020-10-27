<?php
$servername = "localhost";
$dbname="dbdpl";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    //echo "Connection failed: " . $e->getMessage();
	header('Location:installation/database_config.php');
    }
	
	if($_POST){
	
	
	$stmt = $conn->prepare("INSERT INTO items (user_full_name,user_username,user_password, user_status) VALUES (?, ?, ?, ?)");
	
	$stmt->bindParam(1, $user_full_name);
	$stmt->bindParam(2, $user_username);
	$stmt->bindParam(3, $user_password);
	$stmt->bindParam(4, $user_status);
	// insert one row
	$user_full_name = $_POST['user_full_name'];
	$user_username = 'admin';
	$user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
	$user_status='admin';
	$stmt->execute();
	}
	header('Location:../index.php');