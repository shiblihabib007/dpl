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
	
	
	$stmt = $conn->prepare("INSERT INTO company (company_full_name,company_title,address_line_1, address_line_2, address_line_3) VALUES (?, ?, ?, ?,?)");
	
	$stmt->bindParam(1, $company_full_name);
	$stmt->bindParam(2, $company_title);
	$stmt->bindParam(3, $address_line_1);
	$stmt->bindParam(4, $address_line_2);
	$stmt->bindParam(5, $address_line_3);
	// insert one row
	$company_full_name = $_POST['company_full_name'];
	$company_title = $_POST['company_title'];
	$address_line_1 = $_POST['address_line_1'];
	$address_line_2 = $_POST['address_line_2'];
	$address_line_3 = $_POST['address_line_3'];
	$stmt->execute();
	}
	header('Location:super_admin_info_insert.php');