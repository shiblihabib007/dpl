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
<h4 class="text-center alert alert-info">Approve This Expense!</h4>
<?php


	
	
	if(isset($_GET)){
		$id=$_GET['id'];
		
	}
	
		
		
	$sql="SELECT * FROM expenses WHERE id='$id'";
$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {	
	
		$row=mysqli_fetch_array($result);
			
			
			
		
			$_SESSION['id']=$row['id'];
			$_SESSION['category_name']=$row['expense_catagory_name'];
			$_SESSION['amount']=$row['expense_amount'];

		
		?>
		<form action="expense_reject_confirm.php"  method="post">
		<div class="form-group col-md-6 col-md-offset-3">
			
			<label for="expense_category_name">Expense Category</label>
			<input type="text" name="expense_category_name" class="form-control" value="<?php echo $_SESSION['category_name']; ?>" disabled>
			</br>
			<label for="amount">Amount</label>
			
			<input type="number" name="amount" class="form-control" value="<?php echo $_SESSION['amount']; ?>" disabled>
			</br>
			
			
			<button class="btn btn-default btn-primary" name="submit"> Reject</button>
			</div>
		</form>
<?php
		
	}

	
	
	
?>
</div>			
<?php require 'footer.php';?>