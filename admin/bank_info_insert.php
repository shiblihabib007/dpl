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
	
	
	$sql = "INSERT INTO banks (bank_bank_name , bank_bank_branch_name, bank_bank_account_number,bank_bank_routing_number)
		VALUES ('$bank_full_name','$branch_name','$account_number','$routing_number')";

	if ($conn->query($sql) == TRUE) {												
		$_SESSION["success_msg"]="Successfully Added Bank info ! ";	
		header('Location:add_bank_to_system.php');		
	}
	
	
									

}else{
	$_SESSION["error_msg"]="Bank info not added ! ";	
	header('Location:add_bank_to_system.php');
	
}
//
?>

</div>


<?php require 'footer.php';?>