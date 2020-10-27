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
	try{
	$address_line_1 = $_POST['address_line_1'];
	$address_line_2 = $_POST['address_line_2'];
	$address_line_3 = $_POST['address_line_3'];
	
	 $sql = "UPDATE company SET address_line_1='$address_line_1', address_line_2='$address_line_2', address_line_3='$address_line_3'";
	
	// Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();
	$_SESSION["Success_msg"]="Updated Successfully !";
    // echo a message to say the UPDATE succeeded
    
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	}
	header('Location:company_info.php');