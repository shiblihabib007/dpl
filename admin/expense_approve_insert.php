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

if(isset($_POST)){
	$id=$_SESSION['id'];
	$category_name=$_SESSION['category_name'];
	$amount=$_SESSION['amount'];
	$expense_narration=$_SESSION['expense_narration'];
	
					
	//search CASH balance start
	$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
	$db_banks_result = mysqli_query($conn, $sql_bank_search);
	$row_banks_details=mysqli_fetch_array($db_banks_result);
	$bank_old_balance=$row_banks_details['bank_cash_balance'];
	$bank_balance=$row_banks_details['bank_cash_balance'];
	
	
	if($bank_balance > $amount){
		$bank_balanace=$bank_balance - $amount;
		//search CASH balance start
		
		//insert to CASH start
		$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
		$conn->query($sql_bank);
	//insert to CASH end	
		
		
		

		$sql = "UPDATE expenses SET expense_approve_status='approved' WHERE id='$id'";
		
		if ($conn->query($sql) === TRUE) {
			
		
		$sql_report = "INSERT INTO reports (report_expense_category_name,report_transection_status,report_expense_debit,report_cash_old_balance,report_cash_new_balance )
		VALUES ('$category_name','expense','$amount','$bank_old_balance','$bank_balanace=')";
		$conn->query($sql_report);
		
						
		
		$_SESSION["purchase_Success_msg"]="Expense Approved !";	
			//$_SESSION["Success_msg"]="Bill and Challan Is Successfully Created !";
			//header('refresh:3; url=price_quotation_insert.php');
			
			
			header('Location:home.php');
			
		} else {
			$_SESSION["error_msg"]="Expense is too big, greater then your balance!";
		header('Location:home.php');
		}
		
	}else{
		$_SESSION["error_msg"]="Expense is too big, greater then your balance!";
		header('Location:home.php');
		
		
	}
	
	
	
	
	
			

		
	
	
	
}



?>

</div>


<?php require 'footer.php';?>