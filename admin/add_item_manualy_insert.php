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

		$stmt = $conn->prepare("INSERT INTO items (item_catagory_name,item_model_name,item_size, item_price) VALUES (?, ?, ?, ?)");
		
		$stmt->bindParam(1, $item_catagory_name);
		$stmt->bindParam(2, $item_model_name);
		$stmt->bindParam(3, $item_size);
		$stmt->bindParam(4, $item_price);
		// insert one row
		$item_catagory_name = ucwords($_POST['item_catagory_name']);
		$item_model_name =  ucwords($_POST['item_model_name']);
		$item_size = $_POST['item_size'];
		$item_price = $_POST['item_price'];
		$stmt->execute();
		$_SESSION["Success_msg"]="Item Is Successfully Added !";
		} 
		catch (PDOException $e) {
			echo "The user could not be added.<br>".$e->getMessage();
		}
	
}
	header('Location:add_item_manualy_info.php');	
	
	
	
