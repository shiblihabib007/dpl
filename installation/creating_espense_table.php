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
    $sql = "CREATE TABLE expenses (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    expense_catagory_name VARCHAR(100) NOT NULL,
    expense_amount FLOAT(6) NOT NULL,
    expense_narration VARCHAR(100) NOT NULL,
	expense_approve_status VARCHAR(10) NOT NULL,
	expense_date TIMESTAMP(6) NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
  //echo $sql . "<br>" . $e->getMessage();
    }
	header('Location:creating_clients_table.php');
	