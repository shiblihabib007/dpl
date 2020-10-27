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
	
if($_POST and isset($_GET['id'])){
	$id=$_GET['id'];
	try{
		$client_company = ucwords($_POST['client_company']);
		$client_full_name = ucwords($_POST['client_full_name']);
		$client_possition = ucwords($_POST['client_possition']);
		$client_depertment = ucwords($_POST['client_depertment']);
		$client_phone_no = $_POST['client_phone_no'];
		$client_email = $_POST['client_email'];
		$client_recievable_vat = $_POST['recivable_vat'];
		$client_payable_vat = $_POST['payable_vat'];
		$client_address_line_1 = ucwords($_POST['client_address_line_1']);
		$client_address_line_2 = ucwords($_POST['client_address_line_2']);
		$client_address_line_3 = ucwords($_POST['client_address_line_3']);
	
	 $sql = "UPDATE clients SET client_company='$client_company',client_full_name='$client_full_name',client_possition='$client_possition', client_depertment='$client_depertment',client_phone_no='$client_phone_no',client_email='$client_email',client_recievable_vat='$client_recievable_vat',client_payable_vat='$client_payable_vat',client_address_line_1='$client_address_line_1',client_address_line_2='$client_address_line_2',client_address_line_3='$client_address_line_3' WHERE id='$id'";
	
	// Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();
	
	$_SESSION["Success_msg"]="Client Info Updated Successfully !";
    // echo a message to say the UPDATE succeeded
    
    }
catch(PDOException $e)
    {
		echo $sql . "<br>" . $e->getMessage();
    }
}
	header('Location:home.php');