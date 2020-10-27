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
$amount=$_SESSION['amount'];
			
		
		
			
				
				$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
				$db_banks_result = mysqli_query($conn, $sql_bank_search);
				$row_banks_details=mysqli_fetch_array($db_banks_result);
				$bank_old_balance=$row_banks_details['bank_cash_balance'];
				$bank_balance=$row_banks_details['bank_cash_balance'];
				
				$bank_balance=$bank_balance + $amount;
				
				
				
				//echo $amount." ".$bank_old_balance;
				
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balance' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_transection_status,report_bank_cash_or_cheque_deposit_amount,report_cash_old_balance,report_cash_new_balance )
						VALUES ('cash deposit','$amount','$bank_old_balance','$bank_balance')";
					$conn->query($sql_report);
					//report insert end
					
					$_SESSION["Cash_success_msg"]="Cash Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				


}
header('Location:home.php');
//header('Location:all_items_for_bill_recieve_cash.php');	
?>

</div>


<?php require 'footer.php';?>