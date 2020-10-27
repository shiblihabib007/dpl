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

	$id=$_SESSION['id'];
	

			
			$sql = "DELETE FROM expenses WHERE id='$id'";

			if ($conn->query($sql) === TRUE) {
				$_SESSION["purchase_reject_msg"]="Expense is Successfully Rejected !";
				//header('refresh:3; url=price_quotation_insert.php');
				header('Location:home.php');
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		
		
							
	
?>
</div>			
<?php require 'footer.php';?>