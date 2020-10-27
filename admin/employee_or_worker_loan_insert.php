<?php
ob_start();
session_start();
if(isset($_SESSION["user"])){
	
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
}

?>
<?php require 'header.php';?>
<?php require 'nav.php';?>
<div class="container">
<?php
if(isset($_POST['submit'])){
	$id=$_SESSION["employee_or_id"];
	$wanted_loan_amount=$_SESSION["wanted_loan_amount"];
	$employee_or_worker_exsisting_loan=$_SESSION["existing_loan"];
	$employee_or_worker_basic_salary=$_SESSION["basic_salary"];	
	$current_balance= $_SESSION["current_balance"];
	
	
	
	$final_loan_amount = $employee_or_worker_exsisting_loan + $wanted_loan_amount;
	$final_current_balance= $current_balance - $wanted_loan_amount;
	
	$sql1 = "UPDATE employee SET employee_loan='$final_loan_amount', employee_current_salary='$final_current_balance'  WHERE id='$id'";						
	$conn->query($sql1);
	if(($conn->query($sql1))==true){
	$_SESSION["employee_or_id"]=null;
	$_SESSION["wanted_loan_amount"]=null;
	$_SESSION["existing_loan"]=null;
	$_SESSION["basic_salary"]=null;	
	$_SESSION["current_balance"]=null;	
	$_SESSION["success_msg"]="Loan is successfully Processed ! ";	
	header('Location:all_employee_and_worker_loan.php');	
	}
	
}
	

?>		
<?php require 'footer.php';?>