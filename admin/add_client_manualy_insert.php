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

		$stmt = $conn->prepare("INSERT INTO clients (client_company,client_full_name,client_possition, client_depertment,client_phone_no,client_email,client_recievable_vat,client_payable_vat,client_address_line_1,client_address_line_2,client_address_line_3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		
		$stmt->bindParam(1, $client_company);
		$stmt->bindParam(2, $client_full_name);
		$stmt->bindParam(3, $client_possition);
		$stmt->bindParam(4, $client_depertment);
		$stmt->bindParam(5, $client_phone_no);
		$stmt->bindParam(6, $client_email);
		$stmt->bindParam(7, $client_recievable_vat);
		$stmt->bindParam(8, $client_payable_vat);
		$stmt->bindParam(9, $client_address_line_1);
		$stmt->bindParam(10, $client_address_line_2);
		$stmt->bindParam(11, $client_address_line_3);
		// insert one row
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
		$stmt->execute();
		$_SESSION["Success_msg"]="Client Is Successfully Added !";
		
		} 
		catch (PDOException $e) {
			echo "The user could not be added.<br>".$e->getMessage();
			
		}
	
}
	header('Location:add_client_manualy_info.php');	
		
	
	
	?>
