<?php
session_start();
if(isset($_SESSION["user"])){
	
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
}

?>
<?php require 'header.php';?>
<?php require 'nav.php';?>

<?php 
		$_SESSION['expense_category']=null;
		$_SESSION['amount']=null;
		$_SESSION['narration']=null;


?>
<div class="container">
<h4 class="text-center alert alert-info">Select Expense Category!</h4>

<?php
if(isset($_SESSION["quantity_empty"])){
	?>
	<h4 class="text-center alert alert-warning"><?php echo $_SESSION["quantity_empty"]; ?> </h4>
	
	
	<?php
	$_SESSION["quantity_empty"]=null;
}
 ?>
</h4>
<?php
/*
$sql_bill_no="SELECT * FROM expense_catagory";
$result_bill = mysqli_query($conn, $sql_bill_no);


	if (mysqli_num_rows($result_bill) > 0) {
		$row_bill = mysqli_fetch_array($result_bill);
		$bill_no=$row_bill['expense_bill_number'];
		
			$bill_no=$bill_no + 1;
		
		
		
		
	}
	if(!isset($bill_no)){
			$bill_no=01;
			
		}
	


	
	*/
	
 $sql = "SELECT * FROM expense_catagory";
	$result = mysqli_query($conn, $sql);
	

	if (mysqli_num_rows($result) > 0) {
		
		
		?>
		<form action="expense_confirm.php" method="post">
		<div class="form-group col-md-6 col-md-offset-3">
			<select class="form-control" id="exampleFormControlSelect1" name="expense_category">
			<?php
			
			if (mysqli_num_rows($result) > 0) {
		
		
				while($expense_data= mysqli_fetch_array($result)) {
				$expense_category=$expense_data['expense_catagory_name'];
				
					
				
				
				?>
		
		
				<option value="<?php echo $expense_category ; ?>"><?php echo $expense_category; ?></option>
		
			<?php
				}	
			}

			?>
			  
			  
			</select>
			</br>
			<label for="exampleFormControlSelect1" >Total Amount</label>
			<input type="number" name="amount" class="form-control" placeholder="Total Amount" autofocus >
			</br>
			<label for="narration" >Narration</label>
			<input type="text" name="narration" class="form-control text-capitalize" placeholder="Description" autofocus >	
	</br>
  <button class="btn btn-default btn-primary" name="submit"> Submit</button>
		</div>
		
	
</form>
  <?php
	}
	
			
			?>
			
</div>

<?php require 'footer.php';?>