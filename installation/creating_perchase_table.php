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
    $sql = "CREATE TABLE perchases (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    parchase_bill_number INT(5) NOT NULL,
   
    parchase_supplier_full_name VARCHAR(100) NOT NULL,
    parchase_item_name VARCHAR(100) NOT NULL,
	
    parchase_item_qty VARCHAR(5) NOT NULL,
    parchase_item_unit VARCHAR(5) NOT NULL,
	
	parchase_item_price VARCHAR(5) NOT NULL,
	parchase_item_total_price VARCHAR(5) NOT NULL,
	parchase_approve_status VARCHAR(10) NOT NULL,
	parchase_date TIMESTAMP(6) NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
  //echo $sql . "<br>" . $e->getMessage();
    }
	header('Location:creating_espense_table.php');
	