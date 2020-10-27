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
    $sql = "CREATE TABLE banks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	bank_cash_account VARCHAR(15) NOT NULL,
	bank_cash_balance FLOAT(10) NOT NULL,
    bank_bank_name VARCHAR(100) NOT NULL,
    bank_bank_branch_name VARCHAR(30) NOT NULL,
    bank_bank_account_number VARCHAR(15) NOT NULL,
    bank_bank_routing_number VARCHAR(15) NOT NULL,
    bank_bank_acc_balance FLOAT(10) NOT NULL,
    bank_transection_date TIMESTAMP(6) NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
   //echo $sql . "<br>" . $e->getMessage();
    }
	
	
	
	//insert data to database start
	try {
    $sql1 = "INSERT INTO accounts (acc_cash_account)
	VALUES ('CASH')";

    // use exec() because no results are returned
    $conn->exec($sql1);
    }
catch(PDOException $e)
    {
   //echo $sql . "<br>" . $e->getMessage();
    }
	//insert data to database end 
	
	
	header('Location:creating_reports_table.php');
	