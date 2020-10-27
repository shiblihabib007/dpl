<?php 
require '../auth.php';

	if(isset($_POST['submit'])){
		$user_username1=$_POST['user_username'];
	
		
	$sql = "SELECT * FROM user WHERE user_username='$user_username1'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if(isset($row )){
		header('Location:user_info.php');
	}else{
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
	$stmt = $conn->prepare("INSERT INTO user (user_full_name,user_username,user_password, user_status) VALUES (?, ?, ?, ?)");
	
	$stmt->bindParam(1, $user_full_name);
	$stmt->bindParam(2, $user_username);
	$stmt->bindParam(3, $user_password);
	$stmt->bindParam(4, $user_status);
	// insert one row
	$user_full_name = $_POST['user_full_name'];
	$user_username=$_POST['user_username'];
	$user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
	$user_status='employee';
	$stmt->execute();
	header('Location:finish.php');
	}
	
	
	/*
	
	*/
	}
	