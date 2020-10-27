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
    $sql = "CREATE TABLE reports (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    report_purchase_bill_no VARCHAR(8) NOT NULL,
	report_purchase_suplier_name VARCHAR(100) NOT NULL,
	report_expense_category_name VARCHAR(100) NOT NULL,
	report_purchase_debit FLOAT(8) NOT NULL,
    report_expense_debit FLOAT(8) NOT NULL,
    report_sale_bill_no VARCHAR(8) NOT NULL,
	report_sale_company_name VARCHAR(100) NOT NULL,
    report_transection_status VARCHAR(50) NOT NULL,
    report_sale_cheque_no VARCHAR(15) NOT NULL,
    
    
    report_sale_purchase_payment_cheque_no VARCHAR(15) NOT NULL,
    report_bank_name VARCHAR(100) NOT NULL,
    report_bank_acc_no VARCHAR(15) NOT NULL,
    report_bank_old_balance FLOAT(6) NOT NULL,
    report_bank_cheque_no_deposit_or_withdraw FLOAT(6) NOT NULL,
	
    report_bank_cash_or_cheque_deposit_amount FLOAT(6) NOT NULL,
    report_bank_cash_or_cheque_withdraw_amount FLOAT(6) NOT NULL,
    report_bank_cash_deposit_amount FLOAT(6) NOT NULL,
    report_bank_new_balance FLOAT(6) NOT NULL,
	report_cash_old_balance FLOAT(6) NOT NULL,
    report_cash_new_balance FLOAT(6) NOT NULL,
    report_bill_credit FLOAT(8) NOT NULL,
    report_bill_credit_vat FLOAT(5) NOT NULL,
    report_bill_debit_vat FLOAT(5) NOT NULL,
    
    report_transection_date TIMESTAMP(6) NOT NULL
	
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
   //echo $sql . "<br>" . $e->getMessage();
    }
	header('Location:creating_operations_table.php');
	