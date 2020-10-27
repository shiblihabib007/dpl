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
	
//image upload start-----------------------------------------------------
$cheque_base_name=trim($_SESSION["final_cheque_no"]);


	$target_dir = "cheque/";
	$old_file_name=basename($_FILES["fileToUpload"]["name"]);
	$userfile_extn = explode(".", strtolower($_FILES["fileToUpload"]["name"]));
	
	$new_file_name=$cheque_base_name.".".$userfile_extn[1];
	
	 //rename($old_file_name, $new_file_name);
	
	//$final_name=rename( "../".$old_file_name, $new_file_name) ; 
	$target_file = $target_dir . $new_file_name;
	
	
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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


	
	$bill_numbers=$_SESSION["final_list_of_bill_no"];
	$company_full_name=$_SESSION["final_list_of_company_full_name"];
	$due_per_bill=$_SESSION["final_list_of_dues"];
	$cheque_no=$_SESSION["final_cheque_no"];
	$amount_of_taka_of_cheque=$_SESSION["final_cheque_amount"];	
	$total_dues=$_SESSION["total_dues"];
	
	$bank_account_number=$_SESSION["account_number"];
	$acc_bank_acc_balance=$_SESSION["acc_bank_acc_balance"];
	
	$net_vat=$_SESSION["net_vat"];
	$total_due_after_count_both_vat=$_SESSION["grand_total_after_adjust_vat"];
	$grace_amount=$_SESSION["grace_or_due"];
	
	
	$vat_per_bill_given_by_client_adjusted=$_SESSION["vat_per_bill_from_client_list_after_adjust"];
	$vat_per_bill_client_wanted=$_SESSION["vat_per_bill_to_client_list"];
	
	
	//update ase mone hoy
	
	
	
	
	
	
	// accounts update start
	//$acc_bank_acc_balance=$acc_bank_acc_balance + $amount_of_taka_of_cheque;
	//$sql_acc = "UPDATE accounts SET acc_bank_acc_balance='$acc_bank_acc_balance' WHERE acc_bank_account_number='$bank_account_number'";						
	//$conn->query($sql_acc);
	// accounts update end
	
	$total_bill_number=sizeof($bill_numbers);
	
	
	
	
	for($x=0; $x <= $total_bill_number-1; $x++){
				//bank name
				$sql_bank_search1="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
					$db_banks_result1 = mysqli_query($conn, $sql_bank_search1);
					$row_banks_details1=mysqli_fetch_array($db_banks_result1);
					$bank= $row_banks_details1['bank_bank_name'];
				//bank name end	
				$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_old_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balance=$row_banks_details['bank_bank_acc_balance'];
				
				$due_per_bill_with_vat_adjusted=$due_per_bill[$x] + $vat_per_bill_given_by_client_adjusted[$x];
				
				
				if(($amount_of_taka_of_cheque >= $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cheque > 0) ){
					
					//echo $amount_of_taka_of_cheque." -1- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
			
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_company_fullname=$row['acc_company_full_name'];
					$db_debit_vat=$row['acc_bill_reducable_by_client_vat'];
					$db_due=$row['acc_bill_due'];
					$db_acc_bill_credit_vat=$row['acc_bill_credit_vat'];
					
					
					$db_credit=$row['acc_bill_credit'];
					
					
					$credit=$db_credit + $due_per_bill[$x];
					$credit_vat=$db_acc_bill_credit_vat + $vat_per_bill_given_by_client_adjusted[$x];
					$amount_of_taka_of_cheque=$amount_of_taka_of_cheque - $due_per_bill_with_vat_adjusted;
					
					$sql1 = "UPDATE accounts SET acc_bill_credit_method='cheque',acc_bill_credit_cheque_no='$cheque_no', acc_bill_credit='$credit',acc_bill_credit_vat='$credit_vat', acc_bill_due='0', acc_bill_due_vat_adjusted='0'  WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql1);
					
					
					

					//search bank balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_old_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balanace=$bank_balance + $due_per_bill[$x] + $vat_per_bill_given_by_client_adjusted[$x];
					//search bank balance start

					//insert to bank start
					$sql_bank = "UPDATE banks SET bank_bank_acc_balance='$bank_balanace' WHERE bank_bank_account_number='$bank_account_number'";						
					$conn->query($sql_bank);
					//insert to bank end
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_sale_cheque_no,report_bank_name,report_bank_acc_no,report_bill_credit,report_bill_credit_vat,report_bank_old_balance,report_bank_new_balance )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cheque','$cheque_no','$bank','$bank_account_number','$due_per_bill[$x]','$vat_per_bill_given_by_client_adjusted[$x]','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					
					
					$_SESSION["cheque_success_msg"]="Cheque Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
					
				
				}
				
				elseif(($amount_of_taka_of_cheque < $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cheque >= $vat_per_bill_given_by_client_adjusted[$x]) and ($_POST['grace_or_due']=='due') and ($amount_of_taka_of_cheque > 0) ){
					//echo $amount_of_taka_of_cheque." -2- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_company_fullname=$row['acc_company_full_name'];
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					
						
					
					
					$db_credit_vat_recievable_from_client=$row['acc_bill_credit_vat'];
					$credit_vat=$db_credit_vat_recievable_from_client + $vat_per_bill_given_by_client_adjusted[$x];
					$amount_of_taka_of_cheque=$amount_of_taka_of_cheque - $vat_per_bill_given_by_client_adjusted[$x];
					
					$credit=$db_credit + $amount_of_taka_of_cheque;
					$due=$due_per_bill[$x] - $amount_of_taka_of_cheque;
					
					
					
					$sql2 = "UPDATE accounts SET acc_bill_credit_method='cheque',acc_bill_credit_cheque_no='$cheque_no', acc_bill_credit='$credit',acc_bill_credit_vat='$credit_vat',acc_bill_due_vat_adjusted='0', acc_bill_due='$due'  WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql2);
					
					

					//search bank balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_old_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balanace=$bank_balance + $amount_of_taka_of_cheque + $vat_per_bill_given_by_client_adjusted[$x];
					//search bank balance start

					//insert to bank start
					$sql_bank = "UPDATE banks SET bank_bank_acc_balance='$bank_balanace' WHERE bank_bank_account_number='$bank_account_number'";						
					$conn->query($sql_bank);
					//insert to bank end
					
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_sale_cheque_no,report_bank_name,report_bank_acc_no, 	report_bill_credit,report_bill_credit_vat,report_bank_old_balance,report_bank_new_balance )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cheque','$cheque_no','$bank','$bank_account_number','$amount_of_taka_of_cheque','$vat_per_bill_given_by_client_adjusted[$x]','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					
					
					$amount_of_taka_of_cheque=0;
					
					$_SESSION["cheque_success_msg"]="Cheque Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cheque < $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cheque < $vat_per_bill_given_by_client_adjusted[$x]) and ($_POST['grace_or_due']=='due') and ($amount_of_taka_of_cheque > 0) ){
					//echo $amount_of_taka_of_cheque." -3- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_company_fullname=$row['acc_company_full_name'];
					
					
					$db_credit_vat_recievable_from_client=$row['acc_bill_credit_vat'];
					$credit_vat=$db_credit_vat_recievable_from_client + $amount_of_taka_of_cheque;
					
					$due_vat=$vat_per_bill_given_by_client_adjusted[$x]- $amount_of_taka_of_cheque;
					
					
					$sql3 = "UPDATE accounts SET acc_bill_credit_method='cheque',acc_bill_credit_cheque_no='$cheque_no',acc_bill_credit_vat='$credit_vat', acc_bill_due_vat_adjusted='$due_vat'  WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql3);
					
					

					//search bank balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_old_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balanace=$bank_balance + $amount_of_taka_of_cheque;
					//search bank balance start

					//insert to bank start
					$sql_bank = "UPDATE banks SET bank_bank_acc_balance='$bank_balanace' WHERE bank_bank_account_number='$bank_account_number'";						
					$conn->query($sql_bank);
					//insert to bank end
					
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_sale_cheque_no,report_bank_name,report_bank_acc_no, 	report_bill_credit,report_bill_credit_vat,report_bank_old_balance,report_bank_new_balance )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cheque','$cheque_no','$bank','$bank_account_number','0','$amount_of_taka_of_cheque','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					$amount_of_taka_of_cheque=0;
					$_SESSION["cheque_success_msg"]="Cheque Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cheque < $due_per_bill_with_vat_adjusted) and ($_POST['grace_or_due']=='due') and ($amount_of_taka_of_cheque == 0) ){
					//echo $amount_of_taka_of_cheque." -4- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);
					$db_company_fullname=$row['acc_company_full_name'];
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					
					
					$amount_of_taka_of_cheque=0;
					
					
					//$sql3 = "UPDATE accounts SET acc_bill_credit_method='cheque',acc_bill_credit_cheque_no='$cheque_no', acc_bill_due='$db_due'  WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					//$conn->query($sql3);	
					$_SESSION["cheque_success_msg"]="Cheque Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cheque < $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cheque >= $vat_per_bill_given_by_client_adjusted[$x])and($_POST['grace_or_due']=='grace') and ($amount_of_taka_of_cheque > 0) ){
					//echo $amount_of_taka_of_cheque." -5- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);
					$db_company_fullname=$row['acc_company_full_name'];
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					$db_credit_vat_recievable_from_client=$row['acc_bill_credit_vat'];
					$credit_vat=$db_credit_vat_recievable_from_client + $vat_per_bill_given_by_client_adjusted[$x];
					
					$amount_of_taka_of_cheque=$amount_of_taka_of_cheque - $vat_per_bill_given_by_client_adjusted[$x];
					
					$credit=$db_credit + $amount_of_taka_of_cheque;
				
					$grace=$due_per_bill[$x] - $amount_of_taka_of_cheque;
					
					
					$sql4 = "UPDATE accounts SET acc_bill_credit_method='cheque',acc_bill_credit_cheque_no='$cheque_no', acc_bill_credit='$credit', acc_bill_credit_vat='$credit_vat', acc_bill_due='0',acc_bill_due_vat_adjusted='0', acc_bill_grace='$grace' WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql4);	
					
					
					

					//search bank balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_old_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balanace=$bank_balance + $amount_of_taka_of_cheque + $vat_per_bill_given_by_client_adjusted[$x];
					//search bank balance start

					//insert to bank start
					$sql_bank = "UPDATE banks SET bank_bank_acc_balance='$bank_balanace' WHERE bank_bank_account_number='$bank_account_number'";						
					$conn->query($sql_bank);
					//insert to bank end
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_sale_cheque_no,report_bank_name,report_bank_acc_no, 	report_bill_credit,report_bill_credit_vat )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cheque','$cheque_no','$bank','$bank_account_number','$amount_of_taka_of_cheque','$vat_per_bill_given_by_client_adjusted[$x]','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					
					$amount_of_taka_of_cheque=0;
					$_SESSION["cheque_success_msg"]="Cheque Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cheque < $due_per_bill_with_vat_adjusted) and ($amount_of_taka_of_cheque < $vat_per_bill_given_by_client_adjusted[$x])and($_POST['grace_or_due']=='grace') and ($amount_of_taka_of_cheque > 0) ){
					//echo $amount_of_taka_of_cheque." -6- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);	
					$db_due=$row['acc_bill_due'];
					$db_company_fullname=$row['acc_company_full_name'];
					$db_credit=$row['acc_bill_credit'];
					
					$db_credit_vat_recievable_from_client=$row['acc_bill_credit_vat'];
					$credit_vat=$db_credit_vat_recievable_from_client + $amount_of_taka_of_cheque;
					
					
					
					
				
					$grace=($vat_per_bill_given_by_client_adjusted[$x] - $amount_of_taka_of_cheque)  + $db_due;
					
					
					$sql5 = "UPDATE accounts SET acc_bill_credit_method='cheque',acc_bill_credit_cheque_no='$cheque_no', acc_bill_credit_vat='$credit_vat', acc_bill_due='0',acc_bill_due_vat_adjusted='0', acc_bill_grace='$grace' WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					$conn->query($sql5);


					
					

					//search bank balance start
					$sql_bank_search="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
					$db_banks_result = mysqli_query($conn, $sql_bank_search);
					$row_banks_details=mysqli_fetch_array($db_banks_result);
					$bank_old_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balance=$row_banks_details['bank_bank_acc_balance'];
					$bank_balanace=$bank_balance + $amount_of_taka_of_cheque;
					//search bank balance start

					//insert to bank start
					$sql_bank = "UPDATE banks SET bank_bank_acc_balance='$bank_balanace' WHERE bank_bank_account_number='$bank_account_number'";						
					$conn->query($sql_bank);
					//insert to bank end
					
					//report insert start
					$sql_report = "INSERT INTO reports (report_sale_bill_no,report_sale_company_name ,report_transection_status,report_sale_cheque_no,report_bank_name,report_bank_acc_no, 	report_bill_credit,report_bill_credit_vat )
						VALUES ('$bill_numbers[$x]','$db_company_fullname','cheque','$cheque_no','$bank','$bank_account_number','0','$amount_of_taka_of_cheque','$bank_old_balance','$bank_balanace')";
					$conn->query($sql_report);
					//report insert end
					
					
					$amount_of_taka_of_cheque=0;
					$_SESSION["cheque_success_msg"]="Cheque Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				elseif(($amount_of_taka_of_cheque < $due_per_bill_with_vat_adjusted) and ($_POST['grace_or_due']=='grace') and ($amount_of_taka_of_cheque ==0) ){
					//echo $amount_of_taka_of_cheque." -7- ".$due_per_bill_with_vat_adjusted."adjusted-".$due_per_bill_with_vat_adjusted."</br>";
					$db_sql="SELECT * FROM accounts WHERE acc_sale_bill_no='$bill_numbers[$x]'";
					$db_result = mysqli_query($conn, $db_sql);
					$row=mysqli_fetch_array($db_result);
					$db_company_fullname=$row['acc_company_full_name'];
					$db_due=$row['acc_bill_due'];
					$db_credit=$row['acc_bill_credit'];
					
					$db_due=$db_due+ $vat_per_bill_given_by_client_adjusted[$x];
					
					$amount_of_taka_of_cheque=0;
					//$sql6 = "UPDATE accounts SET acc_bill_credit_method='cheque',acc_bill_credit_cheque_no='$cheque_no', acc_bill_credit='0', acc_bill_due='0', acc_bill_grace='$db_due' WHERE acc_sale_bill_no='$bill_numbers[$x]'";						
					//$conn->query($sql6);


					$_SESSION["cheque_success_msg"]="Cheque Successfully Deposited ";
					//header('Location:all_Items_for_bill_recieve_cash.php');
				}
				
				
			
			
			}
			
		
		
		
		
		
	//$_SESSION["success_msg"]="Bill successfully received !";
	//header('Location:all_items_for_bill_recieve.php');
	
	
} else {
		

		$_SESSION["error_msg"]="Sorry, there was an error uploading your file.";
		
    }
}

}else{
	
	$_SESSION["error_msg"]="Please check Check image type, Try again with jpg.";
	header('Location:all_items_for_bill_recieve.php');
	
}
}
header('Location:home.php');
?>

</div>


<?php require 'footer.php';?>