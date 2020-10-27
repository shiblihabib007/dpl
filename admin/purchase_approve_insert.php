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
	$parchase_bill_number=$_SESSION['purchase_bill_no'];
	if(!empty($_POST['check_list'])) {
		
		foreach($_POST['check_list'] as $id) {	
		
		$new_qty=$_POST['qty'][$id];
		$new_price=$_POST['item_price'][$id];
			//echo $id."-".$_POST['qty'][$id]."-".$_POST['item_price'][$id]."</br>";
			
									$sql = "UPDATE perchases SET parchase_approve_status='approved' WHERE parchase_bill_number='$parchase_bill_number'";
									
									if ($conn->query($sql) === TRUE) {
										
									$_SESSION["purchase_Success_msg"]="Purchase Approved !";	
										//$_SESSION["Success_msg"]="Bill and Challan Is Successfully Created !";
										//header('refresh:3; url=price_quotation_insert.php');
										
										
										//header('Location:home.php');
										
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}

		
		}
	}
	
	
}
header('Location:purchase_bill_insert_into_accounts.php');


?>

</div>


<?php require 'footer.php';?>