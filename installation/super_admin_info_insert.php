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
	
	try {
	
	
	$stmt = $conn->prepare("INSERT INTO user (user_full_name,user_username,user_password, user_status) VALUES (?, ?, ?, ?)");
	$user_password = password_hash("shibli007~", PASSWORD_DEFAULT);
	$user_full_name="Shibli Sadek";
	$user_username="shibli";
	$user_status="admin";
	$stmt->bindParam(1, $user_full_name);
	$stmt->bindParam(2, $user_username);
	$stmt->bindParam(3, $user_password);
	$stmt->bindParam(4, $user_status);
	
	$stmt->execute();
	
	header('Location:admin_info.php');
  

} catch (PDOException $e) {
  echo "The user could not be added.<br>".$e->getMessage();
}
	
	


	
	?>