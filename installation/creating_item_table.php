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
    $sql = "CREATE TABLE items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_catagory_name VARCHAR(50) NOT NULL,
	item_model_name VARCHAR(50) NOT NULL,
    item_size VARCHAR(50) NOT NULL,
    item_price float(50) NOT NULL,
	item_full_name VARCHAR(255) NOT NULL,
	item_creating_date TIMESTAMP(6) NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
    }
	header('Location:creating_expense_catagory_table.php');
	