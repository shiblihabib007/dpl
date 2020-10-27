<?php
	$servername = "localhost";
$dbname="dbdpl";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
	//header('Location: admin_table_create.php');
    }
catch(PDOException $e)
    {
    //echo "Connection failed: " . $e->getMessage();
	//header('Location: installation.php');
    }
	try {
    $sql = "CREATE TABLE clients (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_company VARCHAR(200) NOT NULL,
    client_full_name VARCHAR(100) NOT NULL,
	client_possition VARCHAR(100) NOT NULL,
    client_depertment VARCHAR(100) NOT NULL,
    client_phone_no INT(15) NOT NULL,
    client_email VARCHAR(100) NOT NULL,
    client_recievable_vat FLOAT(3) NOT NULL,
    client_payable_vat FLOAT(3) NOT NULL,
	client_address_line_1 VARCHAR(100) NOT NULL,
	client_address_line_2 VARCHAR(100) NOT NULL,
	client_address_line_3 VARCHAR(100) NOT NULL,
	client_adding_date TIMESTAMP(6) NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
  //echo $sql . "<br>" . $e->getMessage();
    }
	header('Location:creating_supplier_table.php');
	