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

		$stmt = $conn->prepare("INSERT INTO suppliers (supplier_company,supplier_full_name,supplier_possition, supplier_depertment,supplier_phone_no,supplier_email,supplier_address_line_1,supplier_address_line_2,supplier_address_line_3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		
		$stmt->bindParam(1, $supplier_company);
		$stmt->bindParam(2, $supplier_full_name);
		$stmt->bindParam(3, $supplier_possition);
		$stmt->bindParam(4, $supplier_depertment);
		$stmt->bindParam(5, $supplier_phone_no);
		$stmt->bindParam(6, $supplier_email);
		$stmt->bindParam(7, $supplier_address_line_1);
		$stmt->bindParam(8, $supplier_address_line_2);
		$stmt->bindParam(9, $supplier_address_line_3);
		// insert one row
		$supplier_company = ucwords($_POST['supplier_company']);
		$supplier_full_name = ucwords($_POST['supplier_full_name']);
		$supplier_possition = ucwords($_POST['supplier_possition']);
		$supplier_depertment = ucwords($_POST['supplier_depertment']);
		$supplier_phone_no = $_POST['supplier_phone_no'];
		$supplier_email = $_POST['supplier_email'];
		$supplier_address_line_1 = ucwords($_POST['supplier_address_line_1']);
		$supplier_address_line_2 = ucwords($_POST['supplier_address_line_2']);
		$supplier_address_line_3 = ucwords($_POST['supplier_address_line_3']);
		$stmt->execute();
		$_SESSION["Success_msg"]="supplier Is Successfully Added !";
		
		} 
		catch (PDOException $e) {
			echo "The user could not be added.<br>".$e->getMessage();
			
		}
	
}
	header('Location:add_supplier_manualy_info.php');	
		
	
	
	?>
