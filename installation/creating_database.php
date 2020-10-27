<?php
$servername = "localhost";
$dbname="dbdpl";
$username = "root";
$password = "";

try {
    $mysql = new PDO("mysql:host=localhost", $username, $password);
	$statement = $mysql->prepare("CREATE DATABASE IF NOT EXISTS $dbname");
	$statement->execute();
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	header('Location:creating_company_table.php');
    }
catch(PDOException $e)
    {
    //echo "Connection failed: " . $e->getMessage();
	//header('Location:admin_table_config.php');
    }
	
	
	