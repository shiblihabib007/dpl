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
	$quotation_no=$_POST['quotation_no'];
	if(!empty($_POST['check_list'])) {
		
		foreach($_POST['check_list'] as $id) {	
		
		$new_qty=$_POST['qty'][$id];
		$new_price=$_POST['item_price'][$id];
			//echo $id."-".$_POST['qty'][$id]."-".$_POST['item_price'][$id]."</br>";
			
									$sql = "UPDATE operations SET work_oder_status='delivered' WHERE quotation_no='$quotation_no'  and  item_id='$id'";
									
									if ($conn->query($sql) === TRUE) {
										
										$_SESSION["bill_no"]=$quotation_no;
										//$_SESSION["Success_msg"]="Bill and Challan Is Successfully Created !";
										//header('refresh:3; url=price_quotation_insert.php');
										
										
										//header('Location:home.php');
										header('Location:bill_insert_into_accounts.php');
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}

		
		}
	}
	
	
}



?>

</div>


<?php require 'footer.php';?>