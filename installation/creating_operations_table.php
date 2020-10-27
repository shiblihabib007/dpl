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
    $sql = "CREATE TABLE operations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_id INT(6),
    item_full_name VARCHAR(200) NOT NULL,
    item_qty INT(6) NOT NULL,
    item_price FLOAT(10) NOT NULL,
    client_name VARCHAR(100) NOT NULL,
    quotation_no VARCHAR(10) NOT NULL,
    work_oder_status VARCHAR(20) NOT NULL,
    delivery_date TIMESTAMP(6) NOT NULL
    
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
  //echo $sql . "<br>" . $e->getMessage();
    }
	header('Location:company_info.php');
	