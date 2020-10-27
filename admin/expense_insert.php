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
	
	$expense_category=$_SESSION['expense_category'];
	$amount=$_SESSION['amount'];
	$narration=$_SESSION['narration'];
		
	$sql = "INSERT INTO expenses (expense_catagory_name, expense_amount,expense_narration, expense_approve_status)
		VALUES ('$expense_category','$amount','$narration','pending')";

	

									

	if ($conn->query($sql) === TRUE) {
											
		
		$_SESSION["Success_msg"]="Expense Is Successfully added !";
		//header('refresh:3; url=price_quotation_insert.php');
		
		
		header('Location:home.php');
	}	
}
else{
	header('Location:home.php');
}
?>
</div>			
<?php require 'footer.php';?>