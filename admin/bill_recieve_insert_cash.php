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
	$bill_numbers=$_SESSION["final_list_of_bill_no"];
	$company_full_name=$_SESSION["final_list_of_company_full_name"];
	$due_per_bill=$_SESSION["final_list_of_dues"];
	$amount_of_taka_of_cash=$_SESSION["final_cash_amount"];	
	$total_dues=$_SESSION["total_dues"];
	$total_bill_number=sizeof($bill_numbers);
	
	$total_due_after_count_both_vat=$_SESSION["grand_total_after_adjust_vat"];
	$vat_per_bill_given_by_client=$_SESSION["vat_per_bill_from_client_list"];
	$vat_per_bill_client_wanted=$_SESSION["vat_per_bill_to_client_list"];
	$acc_bill_due_vat_adjusted=$_SESSION["vat_per_bill_from_client_list_after_adjust"];
	
	$vat_per_bill_given_by_client_adjusted=$_SESSION["vat_per_bill_from_client_list_after_adjust"];
	$vat_per_bill_client_wanted=$_SESSION["vat_per_bill_to_client_list"];		
			
		
		
			for($x=0; $x <= $total_bill_number-1; $x++){
				//bank name if some one day you need to diposit to bank, you can use this
				$sql_bank_search1="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
				$db_banks_result1 = mysqli_query($conn, $sql_bank_search1);
				$row_banks_details1=mysqli_fetch_array($db_banks_result1);
				$bank= $row_banks_details1['bank_bank_name'];
				//bank name end	
				$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_old_balance=$row_banks_details['bank_cash_balance'];
					$bank_balance=$row_banks_details['bank_cash_balance'];
				
				$due_per_bill_with_vat_adjusted=$due_per_bill[$x] + $vat_per_bill_given_by_client_adjusted[$x];
				
				if(($amount_of_taka_of_cash >= $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cash > 0) ){
					
					//echo $amount_of_taka_of_cash." -1- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
			
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_bill_due'];
					$db_acc_bill_credit_vat=$row['acc_bill_credit_vat'];
					
					
					$db_credit=$row['acc_bill_credit'];
					
					
					$credit=$db_credit + $due_per_bill[$x];
					$credit_vat=$db_acc_bill_credit_vat + $vat_per_bill_given_by_client_adjusted[$x];
					
					
					$amount_of_taka_of_cash=$amount_of_taka_of_cash - $due_per_bill_with_vat_adjusted;
					
		
					$sql1 = "UPDATE accounts SET acc_bill_credit_method='cash', acc_bill_credit='$credit',acc_bill_credit_vat='$credit_vat', acc_bill_due='0', acc_bill_due_vat_adjusted='0'  WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql1);
					
					
					
					
					//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_old_balance=$row_banks_details['bank_cash_balance'];
					$bank_balance=$row_banks_details['bank_cash_balance'];
					$bank_balanace=$bank_balance + $due_per_bill[$x] + $vat_per_bill_given_by_client_adjusted[$x];
					//search CASH balance start
					
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_bill_credit,report_bill_credit_vat,report_cash_old_balance,report_cash_new_balance )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cash','$due_per_bill[$x]','$vat_per_bill_given_by_client_adjusted[$x]','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					$_SESSION["Cash_success_msg"]="Cash Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				
				
				}
				
				elseif(($amount_of_taka_of_cash < $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cash >= $vat_per_bill_given_by_client_adjusted[$x]) and ($_POST['grace_or_due']=='due') and ($amount_of_taka_of_cash > 0) ){
					//echo $amount_of_taka_of_cash." -2- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					
						
					
					
					$db_credit_vat_recievable_from_client=$row['acc_bill_credit_vat'];
					$credit_vat=$db_credit_vat_recievable_from_client + $vat_per_bill_given_by_client_adjusted[$x];
					$amount_of_taka_of_cash=$amount_of_taka_of_cash - $vat_per_bill_given_by_client_adjusted[$x];
					
					$credit=$db_credit + $amount_of_taka_of_cash;
					$due=$due_per_bill[$x] - $amount_of_taka_of_cash;
					
					
					
					$sql2 = "UPDATE accounts SET acc_bill_credit_method='cash', acc_bill_credit='$credit',acc_bill_credit_vat='$credit_vat',acc_bill_due_vat_adjusted='0', acc_bill_due='$due'  WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql2);	
					
					
					
					
					
					//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_balance=$row_banks_details['bank_cash_balance'];
					$bank_balanace=$bank_balance +$amount_of_taka_of_cash + $vat_per_bill_given_by_client_adjusted[$x];
					//search CASH balance start
					
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_bill_credit,report_bill_credit_vat,report_cash_old_balance,report_cash_new_balance )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cash','$amount_of_taka_of_cash','$vat_per_bill_given_by_client_adjusted[$x]','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					$amount_of_taka_of_cash=0;
					
					
					$_SESSION["Cash_success_msg"]="Cash Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cash < $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cash < $vat_per_bill_given_by_client_adjusted[$x]) and ($_POST['grace_or_due']=='due') and ($amount_of_taka_of_cash > 0) ){
					
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					
					
					
					$db_credit_vat_recievable_from_client=$row['acc_bill_credit_vat'];
					$credit_vat=$db_credit_vat_recievable_from_client + $amount_of_taka_of_cash;
					
					$due_vat=$vat_per_bill_given_by_client_adjusted[$x]- $amount_of_taka_of_cash;
					
					
					
					//echo $amount_of_taka_of_cash." -3- ".$vat_per_bill_given_by_client_adjusted[$x]."credit".$credit_vat."</br>";
					$sql3 = "UPDATE accounts SET acc_bill_credit_method='cash',acc_bill_credit_vat='$credit_vat', acc_bill_due_vat_adjusted='$due_vat'  WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql3);
					
					
					
					//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_balance=$row_banks_details['bank_cash_balance'];
					$bank_balanace=$bank_balance + $amount_of_taka_of_cash ;
					//search CASH balance start
					
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_bill_credit,report_bill_credit_vat,report_cash_old_balance,report_cash_new_balance )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cash','0','$amount_of_taka_of_cash','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					$amount_of_taka_of_cash=0;
					$_SESSION["Cash_success_msg"]="Cash Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cash < $due_per_bill_with_vat_adjusted) and ($_POST['grace_or_due']=='due') and ($amount_of_taka_of_cash == 0) ){
					//echo $amount_of_taka_of_cash." -4- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					
					
					$amount_of_taka_of_cash=0;
					
					
					//$sql4 = "UPDATE accounts SET acc_bill_credit_method='cash', acc_bill_due='$db_due'  WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					//$conn->query($sql4);	
					$_SESSION["Cash_success_msg"]="Cash Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cash < $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cash >= $vat_per_bill_given_by_client_adjusted[$x])and($_POST['grace_or_due']=='grace') and ($amount_of_taka_of_cash > 0) ){
					//echo $amount_of_taka_of_cash." -5- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					$db_credit_vat_recievable_from_client=$row['acc_bill_credit_vat'];
					$credit_vat=$db_credit_vat_recievable_from_client + $vat_per_bill_given_by_client_adjusted[$x];
					
					$amount_of_taka_of_cash=$amount_of_taka_of_cash - $vat_per_bill_given_by_client_adjusted[$x];
					
					$credit=$db_credit + $amount_of_taka_of_cash;
				
					$grace=$due_per_bill[$x] - $amount_of_taka_of_cash;
					
					
					$sql5 = "UPDATE accounts SET acc_bill_credit_method='cash', acc_bill_credit='$credit', acc_bill_credit_vat='$credit_vat', acc_bill_due='0',acc_bill_due_vat_adjusted='0', acc_bill_grace='$grace' WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql5);
					
					
					
					
					//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_balance=$row_banks_details['bank_cash_balance'];
					$bank_balanace=$bank_balance + $amount_of_taka_of_cash + $vat_per_bill_given_by_client_adjusted[$x];
					//search CASH balance start
					
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_bill_credit,report_bill_credit_vat,report_cash_old_balance,report_cash_new_balance )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cash','$amount_of_taka_of_cash','$vat_per_bill_given_by_client_adjusted[$x]','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					$amount_of_taka_of_cash=0;
					
					$_SESSION["Cash_success_msg"]="Cash Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cash < $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cash < $vat_per_bill_given_by_client_adjusted[$x])and($_POST['grace_or_due']=='grace') and ($amount_of_taka_of_cash > 0) ){
					//echo $amount_of_taka_of_cash." -6- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					$db_credit_vat_recievable_from_client=$row['acc_bill_credit_vat'];
					$credit_vat=$db_credit_vat_recievable_from_client + $amount_of_taka_of_cash;
					
					
					
					
				
					$grace=($vat_per_bill_given_by_client_adjusted[$x] - $amount_of_taka_of_cash)  + $db_due;
					
					
					$sql6 = "UPDATE accounts SET acc_bill_credit_method='cash', acc_bill_credit_vat='$credit_vat', acc_bill_due='0',acc_bill_due_vat_adjusted='0', acc_bill_grace='$grace' WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql6);

					
					
					
					
					
					//search CASH balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_cash_account='CASH'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_balance=$row_banks_details['bank_cash_balance'];
					$bank_balanace=$bank_balance +$amount_of_taka_of_cash;
					//search CASH balance start
					
					//insert to CASH start
					$sql_bank = "UPDATE banks SET bank_cash_balance='$bank_balanace' WHERE bank_cash_account='CASH'";						
					$conn->query($sql_bank);
					//insert to CASH end
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_bill_credit,report_bill_credit_vat,report_cash_old_balance,report_cash_new_balance )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cash','0','$amount_of_taka_of_cash','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					$amount_of_taka_of_cash=0;
					
					$_SESSION["Cash_success_msg"]="Cash Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cash < $due_per_bill_with_vat_adjusted) and ($_POST['grace_or_due']=='grace') and ($amount_of_taka_of_cash ==0) ){
					//echo $amount_of_taka_of_cash." -7- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					$db_due=$db_due+ $vat_per_bill_given_by_client_adjusted[$x];
					
					$amount_of_taka_of_cash=0;
					//$sql7 = "UPDATE accounts SET acc_bill_credit_method='cash', acc_bill_credit='0', acc_bill_due='0', acc_bill_grace='$db_due' WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					//$conn->query($sql7);

					
					
					
					$_SESSION["Cash_success_msg"]="Cash Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				
				
			
			
			}
			
		
			
			
			
			
		
		
		
	

}
header('Location:home.php');
//header('Location:all_items_for_bill_recieve_cash.php');	
?>

</div>


<?php require 'footer.php';?>