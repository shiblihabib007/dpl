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
    $sql = "CREATE TABLE accounts (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	
	acc_sale_bill_no VARCHAR(10) NOT NULL,
	acc_company_full_name VARCHAR(200) NOT NULL,
    acc_item_price_in_total FLOAT(10) NOT NULL,
    acc_vat_on_total FLOAT(10) NOT NULL,
	acc_bill_credit_method VARCHAR(6) NOT NULL,
	
    acc_bill_credit_cheque_no VARCHAR(13) NOT NULL,
    acc_bill_credit FLOAT(10) NOT NULL,
    acc_bill_credit_vat FLOAT(10) NOT NULL,
    acc_bill_due FLOAT(10) NOT NULL,
    acc_bill_grace FLOAT(10) NOT NULL,
    acc_bill_due_vat FLOAT(10) NOT NULL,
    acc_bill_due_vat_adjusted FLOAT(10) NOT NULL,
    acc_bill_reducable_by_client_vat FLOAT(10) NOT NULL,
	acc_perchase_bill_no VARCHAR(10) NOT NULL,
	acc_bill_debit_method VARCHAR(6) NOT NULL,
	acc_bill_debit_cheque_no VARCHAR(6) NOT NULL,
	acc_supplier_full_name VARCHAR(200) NOT NULL,
    acc_perchase_debit FLOAT(10) NOT NULL,
    acc_perchase_due FLOAT(10) NOT NULL,
    acc_perchase_grace FLOAT(10) NOT NULL,
	
	
	
    acc_transection_date TIMESTAMP(6) NOT NULL
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
	
	
	header('Location:creating_bank_table.php');
	