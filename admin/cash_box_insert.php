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
	print_r($_POST);
	
	
	$bank_full_name=ucwords($_POST['bank_full_name']);
	$branch_name=ucwords($_POST['branch_name']);
	$account_number=$_POST['account_number'];
	$routing_number=$_POST['routing_number'];
	
	
	$sql = "INSERT INTO banks (bank_cash_account)
		VALUES ('$bank_full_name')";

	if ($conn->query($sql) == TRUE) {												
		$_SESSION["success_msg"]="Successfully Added CASH-BOX ! ";	
		header('Location:add_bank_to_system.php');		
	}
	
	
									

}else{
	$_SESSION["error_msg"]="CASH-BOX not added ! ";	
	header('Location:add_bank_to_system.php');
	
}
//
?>

</div>


<?php require 'footer.php';?>