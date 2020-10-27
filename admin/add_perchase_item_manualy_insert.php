<?php
session_start();
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
	try {

		$stmt = $conn->prepare("INSERT INTO perchase_items (perchase_item_full_name,perchase_item_unit) VALUES (?, ?)");
		
		$stmt->bindParam(1, $perchase_item_full_name);
		$stmt->bindParam(2, $perchase_item_unit);
		
		// insert one row
		$perchase_item_full_name = ucwords($_POST['perchase_item_full_name']);
		$perchase_item_unit = ucwords($_POST['perchase_item_unit']);
		
		$stmt->execute();
		$_SESSION["Success_msg"]="Purchase Item Is Successfully Added !";
		} 
		catch (PDOException $e) {
			echo "The Item could not be added.<br>".$e->getMessage();
		}
	
}
	header('Location:add_perchase_item_manualy_info.php');	
	
	
	
