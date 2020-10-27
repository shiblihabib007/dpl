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
<h4 class="text-center alert alert-info">Confirm This Expense!</h4>
<?php

if(isset($_POST['submit'])){
	
	
	$expense_category=trim($_POST['expense_category']);
	$amount=$_POST['amount'];
	$narration=ucwords($_POST['narration']);
	

		
		?>
		<form action="expense_insert.php"  method="post">
		<div class="form-group col-md-6 col-md-offset-3">
			
			<label for="expense_category_name">Expense Category</label>
			<input type="text" name="expense_category_name" class="form-control" value="<?php echo $expense_category; ?>">
			</br>
			<label for="amount">Amount</label>
			
			<input type="number" name="amount" class="form-control" value="<?php echo $amount; ?>">
			</br>
			</br>
			<label for="narration" >Narration</label>
			<input type="text" name="narration" class="form-control text-capitalize" value="<?php echo $narration; ?>"  >	
			</br>
			<button class="btn btn-default btn-primary" name="submit"> Confirm</button>
			</div>
			
		</form>
<?php
		
	$_SESSION['expense_category']=	$expense_category;
	$_SESSION['amount']=	$amount;
	$_SESSION['narration']=	$narration;
		

		
	}
	else{
		
		$_SESSION["quantity_empty"]="Item is not selected! please select carefully. ";
		header('Location:all_espense_items.php');
	}
	
	
	
?>
</div>			
<?php require 'footer.php';?>