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
			
									$sql = "UPDATE operations SET item_qty=$new_qty, item_price=$new_price WHERE quotation_no='$quotation_no'  and  item_id='$id'";
									
									if ($conn->query($sql) === TRUE) {
										$_SESSION["Success_msg"]="Quotation Is Successfully UPDATED !";
										//header('refresh:3; url=price_quotation_insert.php');
										header('Location:home.php');
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}

		
		}
	}
	
	
}



?>

</div>


<?php require 'footer.php';?>