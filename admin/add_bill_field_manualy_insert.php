<?php
session_start();

$servername = "localhost";
$dbname="dbdpl";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	
if($_POST){
	$name=trim($_POST['bill_field_name']);
	$name=ucwords($name);
		
	$sql = "SELECT * FROM bills WHERE bills_name='$name' ";
	$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
		$_SESSION["error_msg"]="Bill Field is exist !";
			header('Location:add_bill_field_info.php');	
   
    }
	else{
		$sql = "INSERT INTO bills (bills_name)
		VALUES ('$name')";

			if (mysqli_query($conn, $sql)) {
			$_SESSION["Success_msg"]="Bill Field Successfully Added !";
			header('Location:add_bill_field_info.php');	
		} else {
			$_SESSION["error_msg"]="Bill Field is exist !";
			header('Location:add_bill_field_info.php');	
			
		
		}

		
	}
}	