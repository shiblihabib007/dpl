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
	$grace_or_due=$_POST['grace_or_due'];
	
	
	
	$bill_numbers=$_SESSION["final_list_of_purchase_bill_no"];
	$supplier_full_name=$_SESSION["final_list_of_supplier_full_name"];
	$due_per_purchase_bill=$_SESSION["final_list_of_purchase_dues"];
	$amount_of_taka_of_cash=$_SESSION["final_payment_cash_amount"];
	$total_purchase_dues=$_SESSION["total_purchase_dues"];
			
	$total_bill_number=sizeof($bill_numbers);	
		
			for($x=0; $x <= $total_bill_number -1; $x++){
				echo "bill no-".$bill_numbers[$x]."supplier-".$supplier_full_name[$x]."due for this bill-".$due_per_purchase_bill[$x]."cash-".$amount_of_taka_of_cash."Total dues".$total_purchase_dues."</br>";
				//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					
					$bank_balance_old=$row_banks_details['bank_cash_balance'];
					$bank_balance=$row_banks_details['bank_cash_balance'];
					
					
				if(($amount_of_taka_of_cash >= $due_per_purchase_bill[$x]) and ($amount_of_taka_of_cash > 0) ){
					
					//echo $amount_of_taka_of_cash." -1- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
			
					$db_sql="SELECT * FROM accounts WHERE acc_perchase_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_perchase_due'];
					$db_debit=$row['acc_perchase_debit'];
					
					
					$db_debit=$db_debit + $due_per_purchase_bill[$x];
					
		
					$sql1 = "UPDATE accounts SET acc_bill_debit_method='cash',acc_perchase_due='0',acc_perchase_debit='$db_debit' WHERE acc_perchase_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql1);
					

					
					//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					
					$bank_balance_old=$row_banks_details['bank_cash_balance'];
					$bank_balance=$row_banks_details['bank_cash_balance'];
					$bank_balanace=$bank_balance - $due_per_purchase_bill[$x];
					//search CASH balance start
					
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_purchase_bill_no,report_purchase_suplier_name ,report_transection_status,report_cash_old_balance,report_purchase_debit,report_cash_new_balance )
						VALUES ('$bill_numbers[$x]','$supplier_full_name[$x]','cash payment','$bank_balance_old','$due_per_purchase_bill[$x]','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					$amount_of_taka_of_cash=$amount_of_taka_of_cash - $due_per_purchase_bill[$x];
					
					
					$_SESSION["purchase_Success_msg"]="Cash Payment Successfully done! ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				
				
				}
				elseif(($amount_of_taka_of_cash < $due_per_purchase_bill[$x]) and ($amount_of_taka_of_cash > 0 and ($grace_or_due=='due') ) ){
					
					//echo $amount_of_taka_of_cash." -1- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
			
					$db_sql="SELECT * FROM accounts WHERE acc_perchase_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_perchase_due'];
					$db_debit=$row['acc_perchase_debit'];
					
					
					$db_debit=$db_debit + $amount_of_taka_of_cash;
					
					$db_due=$db_due-$amount_of_taka_of_cash;
					
		
					$sql1 = "UPDATE accounts SET acc_bill_debit_method='cash',acc_perchase_due='$db_due',acc_perchase_debit='$db_debit' WHERE acc_perchase_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql1);
					

					
					//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					
					$bank_balance_old=$row_banks_details['bank_cash_balance'];
					$bank_balance=$row_banks_details['bank_cash_balance'];
					$bank_balanace=$bank_balance - $amount_of_taka_of_cash;
					//search CASH balance start
					
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_purchase_bill_no,report_purchase_suplier_name ,report_transection_status,report_cash_old_balance,report_purchase_debit,report_cash_new_balance )
						VALUES ('$bill_numbers[$x]','$supplier_full_name[$x]','cash payment','$bank_balance_old','$amount_of_taka_of_cash','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					$amount_of_taka_of_cash=0;
					
					
					$_SESSION["purchase_Success_msg"]="Cash Payment Successfully done! ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				
				
				}
				
				elseif(($amount_of_taka_of_cash < $due_per_purchase_bill[$x]) and ($amount_of_taka_of_cash > 0) and ($grace_or_due=='grace') ){
					
					//echo $amount_of_taka_of_cash." -1- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
			
					$db_sql="SELECT * FROM accounts WHERE acc_perchase_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_perchase_due'];
					$db_debit=$row['acc_perchase_debit'];
					
					
					$db_debit=$db_debit + $amount_of_taka_of_cash;
					
					$db_due=$db_due-$amount_of_taka_of_cash;
					
					$grace= $due_per_purchase_bill[$x] - $amount_of_taka_of_cash;
		
					$sql1 = "UPDATE accounts SET acc_bill_debit_method='cash',acc_perchase_due='0',acc_perchase_debit='$db_debit',acc_perchase_grace='$grace' WHERE acc_perchase_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql1);
					

					
					//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					
					$bank_balance_old=$row_banks_details['bank_cash_balance'];
					$bank_balance=$row_banks_details['bank_cash_balance'];
					$bank_balanace=$bank_balance - $amount_of_taka_of_cash;
					//search CASH balance start
					
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_purchase_bill_no,report_purchase_suplier_name ,report_transection_status,report_cash_old_balance,report_purchase_debit,report_cash_new_balance )
						VALUES ('$bill_numbers[$x]','$supplier_full_name[$x]','cash payment','$bank_balance_old','$amount_of_taka_of_cash','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					$amount_of_taka_of_cash=0;
					
					
					$_SESSION["purchase_Success_msg"]="Cash Payment Successfully done! ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				
				
				}
				
				
			
			
			}
			
		
			
			
			
			
		
		
		
	

}
header('Location:home.php');
//header('Location:all_items_for_bill_recieve_cash.php');	
?>

</div>


<?php require 'footer.php';?>