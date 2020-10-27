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
	
	
	//unlink('path_to_filename');
	
	if(isset($_POST['bill_no'])){
		$bill_no=$_POST['bill_no'];
		$voucher_name=$bill_no.".jpg";
		$target_dir = "voucher/";
	$target_file = $target_dir .$voucher_name ;

	if (file_exists($target_file)) {
	   
		
		
		unlink('' . $target_file);
	}
	
		
		
			
			$sql = "DELETE FROM perchases WHERE parchase_bill_number='$bill_no'";

			if ($conn->query($sql) === TRUE) {
				$_SESSION["purchase_reject_msg"]="Purchase is Successfully Rejected !";
				//header('refresh:3; url=price_quotation_insert.php');
				header('Location:home.php');
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		
		}
							
	}												
	else{
		header('Location:home.php');
	}
?>
</div>			
<?php require 'footer.php';?>