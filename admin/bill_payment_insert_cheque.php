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
		$amount_of_taka_of_cheque=$_SESSION["final_payment_cheque_amount"];
		$total_purchase_dues=$_SESSION["total_purchase_dues"];
		$acc_bank_account_number=$_SESSION["bank_acc_naumber"];
		$cheque_no=$_SESSION["cheque_no"];
		
		
		
		$cheque_base_name=trim($cheque_no);
		
			//image upload start-----------------------------------------------------
			$target_dir = "paymentCheque/";
			$old_file_name= basename($_FILES["fileToUpload"]["name"]);
			$userfile_extn = explode(".", strtolower($_FILES["fileToUpload"]["name"]));
			$new_file_name=$cheque_base_name.".".$userfile_extn[1];
			
			$target_file = $target_dir . $new_file_name;
			
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			if($imageFileType!=='png' and $imageFileType=='jpg' and $imageFileType!=='jpeg'){

			// Check if image file is a actual image or fake image
			if (file_exists($target_file)==true) {
			  
				$_SESSION["error_msg"]="Sorry, file already exists.";
				$uploadOk = 0;
				header('Location:all_items_for_bill_recieve.php');
				
				//unlink('' . $target_file);
			}

			// Check file size

			// Allow certain file formats

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				
				$_SESSION["error_msg"]="Sorry, This cheque is already exists.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$_SESSION["cheque_upload_success"]="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					
				

			//image upload end-----------------------------------------------------	
		
		
				
		$total_bill_number=sizeof($bill_numbers);

		
			
				for($x=0; $x <= $total_bill_number -1; $x++){
					//echo "bill no-".$bill_numbers[$x]."supplier-".$supplier_full_name[$x]."due for this bill-".$due_per_purchase_bill[$x]."cash-".$amount_of_taka_of_cheque."Total dues".$total_purchase_dues."</br>";
						$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$acc_bank_account_number'";
						$db_banks_result = mysqli_query($conn, $sql_bank_search);
						$row_banks_details=mysqli_fetch_array($db_banks_result);
						$bank_bank_name=$row_banks_details['bank_bank_name'];
						$bank_balance_old=$row_banks_details['bank_bank_acc_balance'];
						$bank_balance=$row_banks_details['bank_bank_acc_balance'];
				
				
					if($amount_of_taka_of_cheque >= $due_per_purchase_bill[$x] ){
						
						//echo $amount_of_taka_of_cheque." -1- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
				
						$db_sql="SELECT * FROM accounts WHERE acc_perchase_bill_no='$bill_numbers[$x]'";
						$db_result = mysqli_query($conn, $db_sql);
						$row=mysqli_fetch_array($db_result);	
						
						$db_due=$row['acc_perchase_due'];
						$db_debit=$row['acc_perchase_debit'];
						
						
						$db_debit=$db_debit + $due_per_purchase_bill[$x];
						
			
						$sql1 = "UPDATE accounts SET acc_bill_debit_method='cheque',acc_bill_debit_cheque_no='$cheque_no',acc_perchase_due='0',acc_perchase_debit='$db_debit' WHERE acc_perchase_bill_no='$bill_numbers[$x]'";						
						$conn->query($sql1);
						

						
						//search CASH balance start
						$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$acc_bank_account_number'";
						$db_banks_result = mysqli_query($conn, $sql_bank_search);
						$row_banks_details=mysqli_fetch_array($db_banks_result);
						$bank_bank_name=$row_banks_details['bank_bank_name'];
						$bank_balance_old=$row_banks_details['bank_bank_acc_balance'];
						$bank_balance=$row_banks_details['bank_bank_acc_balance'];
						$bank_balanace=$bank_balance - $due_per_purchase_bill[$x];
						//search CASH balance start
						
						//insert to CASH start
						$sql_bank = "UPDATE banks SET bank_bank_acc_balance='$bank_balanace' WHERE bank_bank_account_number='$acc_bank_account_number'";						
						$conn->query($sql_bank);
						//insert to CASH end
						
						
						//report insert start
						$sql_report = "INSERT INTO reports (report_purchase_bill_no,report_purchase_suplier_name ,report_transection_status,report_sale_purchase_payment_cheque_no,report_bank_name,report_cash_old_balance,report_purchase_debit,report_cash_new_balance )
							VALUES ('$bill_numbers[$x]','$supplier_full_name[$x]','cheque payment','$cheque_no','$bank_bank_name','$bank_balance_old','$db_due','$bank_balanace')";
						$conn->query($sql_report);
						//report insert end
						
						
						$_SESSION["purchase_Success_msg"]="Cheque Payment Successfully done! ";
						//header('Location:all_Items_for_bill_recieve_cash.php');
						$amount_of_taka_of_cheque=$amount_of_taka_of_cheque - $due_per_purchase_bill[$x];
					
					}
					elseif(($amount_of_taka_of_cheque < $due_per_purchase_bill[$x]) and ($amount_of_taka_of_cheque > 0 and ($grace_or_due=='due') ) ){
						
						//echo $amount_of_taka_of_cheque." -1- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
				
						$db_sql="SELECT * FROM accounts WHERE acc_perchase_bill_no='$bill_numbers[$x]'";
						$db_result = mysqli_query($conn, $db_sql);
						$row=mysqli_fetch_array($db_result);	
						$db_due=$row['acc_perchase_due'];
						$db_debit=$row['acc_perchase_debit'];
						
						
						$db_debit=$db_debit + $amount_of_taka_of_cheque;
						
						$db_due=$db_due-$amount_of_taka_of_cheque;
						
			
						$sql1 = "UPDATE accounts SET acc_bill_debit_method='cheque',acc_bill_debit_cheque_no='$cheque_no',acc_perchase_due='$db_due',acc_perchase_debit='$db_debit' WHERE acc_perchase_bill_no='$bill_numbers[$x]'";						
						$conn->query($sql1);
						

						
						//search CASH balance start
						$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$acc_bank_account_number'";
						$db_banks_result = mysqli_query($conn, $sql_bank_search);
						$row_banks_details=mysqli_fetch_array($db_banks_result);
						$bank_bank_name=$row_banks_details['bank_bank_name'];
						$bank_balance_old=$row_banks_details['bank_bank_acc_balance'];
						$bank_balance=$row_banks_details['bank_bank_acc_balance'];
						$bank_balanace=$bank_balance - $amount_of_taka_of_cheque;
						//search CASH balance start
						
						//insert to CASH start
						$sql_bank = "UPDATE banks SET bank_bank_acc_balance='$bank_balanace' WHERE bank_bank_account_number='$acc_bank_account_number'";						
						$conn->query($sql_bank);
						//insert to CASH end
						
						
						//report insert start
						$sql_report = "INSERT INTO reports (report_purchase_bill_no,report_purchase_suplier_name ,report_transection_status,report_sale_purchase_payment_cheque_no,report_bank_name,report_cash_old_balance,report_purchase_debit,report_cash_new_balance )
							VALUES ('$bill_numbers[$x]','$supplier_full_name[$x]','cheque payment','$cheque_no','$bank_bank_name','$bank_balance_old','$amount_of_taka_of_cheque','$bank_balanace')";
						$conn->query($sql_report);
						//report insert end
						
						
						
						
						$_SESSION["purchase_Success_msg"]="Cheque Payment Successfully done! ";
						//header('Location:all_Items_for_bill_recieve_cash.php');
					$amount_of_taka_of_cheque=0;
					
					}
					
					elseif(($amount_of_taka_of_cheque < $due_per_purchase_bill[$x]) and ($amount_of_taka_of_cheque > 0) and ($grace_or_due=='grace') ){
						
						//echo $amount_of_taka_of_cheque." -1- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
				
						$db_sql="SELECT * FROM accounts WHERE acc_perchase_bill_no='$bill_numbers[$x]'";
						$db_result = mysqli_query($conn, $db_sql);
						$row=mysqli_fetch_array($db_result);
						
						$db_due=$row['acc_perchase_due'];
						$db_debit=$row['acc_perchase_debit'];
						
						
						$db_debit=$db_debit + $amount_of_taka_of_cheque;
						
						$db_due=$db_due-$amount_of_taka_of_cheque;
						
						$grace= $due_per_purchase_bill[$x] - $amount_of_taka_of_cheque;
			
						$sql1 = "UPDATE accounts SET acc_bill_debit_method='cheque',acc_bill_debit_cheque_no='$cheque_no',acc_perchase_due='0',acc_perchase_debit='$db_debit',acc_perchase_grace='$grace' WHERE acc_perchase_bill_no='$bill_numbers[$x]'";						
						$conn->query($sql1);
						

						
						//search CASH balance start
						$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$acc_bank_account_number'";
						$db_banks_result = mysqli_query($conn, $sql_bank_search);
						$row_banks_details=mysqli_fetch_array($db_banks_result);
						$bank_bank_name=$row_banks_details['bank_bank_name'];
						$bank_balance_old=$row_banks_details['bank_bank_acc_balance'];
						$bank_balance=$row_banks_details['bank_bank_acc_balance'];
						$bank_balanace=$bank_balance - $amount_of_taka_of_cheque;
						//search CASH balance start
						
						//insert to CASH start
						$sql_bank = "UPDATE banks SET bank_bank_acc_balance='$bank_balanace' WHERE bank_bank_account_number='$acc_bank_account_number'";						
						$conn->query($sql_bank);
						//insert to CASH end
						
						
						//report insert start
						$sql_report = "INSERT INTO reports (report_purchase_bill_no,report_purchase_suplier_name ,report_transection_status,report_sale_purchase_payment_cheque_no,report_bank_name,report_cash_old_balance,report_purchase_debit,report_cash_new_balance )
							VALUES ('$bill_numbers[$x]','$supplier_full_name[$x]','cheque payment','$cheque_no','$bank_bank_name','$bank_balance_old','$amount_of_taka_of_cheque','$bank_balanace')";
						$conn->query($sql_report);
						//report insert end
						
						
						
						
						$_SESSION["purchase_Success_msg"]="Cheque Payment Successfully done! ";
						//header('Location:all_Items_for_bill_recieve_cash.php');
						$amount_of_taka_of_cheque=0;
						
						}
						
						
					
					
					}
					
					
				}	
						
						
			}	
				
				
		}
	

}
header('Location:home.php');

?>

</div>


<?php require 'footer.php';?>