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
	$id=$_SESSION['item_id'];
	$item_catagory_name = ucwords($_POST['item_catagory_name']);
	$item_model_name =  ucwords($_POST['item_model_name']);
	$item_size = $_POST['item_size'];
	$item_price = $_POST['item_price'];
	
	
	try {
$sql = "UPDATE items SET item_catagory_name='$item_catagory_name',item_model_name='$item_model_name',item_size='$item_size',item_price='$item_price' WHERE id='$id'";

		// Prepare statement
		$stmt = $conn->prepare($sql);


		$stmt->execute();
		$_SESSION["Success_msg"]="Item Is Successfully Updated !";
		} 
		catch (PDOException $e) {
			echo "The user could not be added.<br>".$e->getMessage();
		}
	
}
	header('Location:edit_sale_item.php');	
	
	
	
