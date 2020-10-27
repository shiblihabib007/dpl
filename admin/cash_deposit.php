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
<div class="container-fluid">
<h4 class="text-center alert alert-info  ">Cash Deposit!</h4>
				

<?php 
if(isset($_SESSION["error_msg"])){
?>	
	<h4 class="text-center heading-color alert alert-warning">
	<?php echo $_SESSION["error_msg"]; ?>
	
	</h4>;
	<?php
	$_SESSION["error_msg"]=null;
	
}
if(isset($_SESSION["success_msg"])){
?>	
	<h4 class="text-center alert alert-success">
	<?php echo $_SESSION["success_msg"]; ?>
	
	</h4>;
	<?php
	
	$_SESSION["success_msg"]=null;
	
}



$_SESSION['amount']=null;
?>

			<form class="form-horizontal col-md-8 col-md-offset-1" action="cash_confirm.php" method="POST">
			  <div class="form-group">
				<label for="amount" class="col-sm-4 control-label">Cash Amount</label>
				<div class="col-sm-8">
					<input type="number" name="amount" class="form-control text-capitalize" id="amount" onkeypress="return onlyAlphabets(event,this);" aria-describedby="emailHelp" value="CASH" required>
				  </div>
			  </div>
			  
			 
			  <div class="col-sm-6 control-label">
			  <button type="submit" name="submit" class="btn btn-primary next">Deposit</button>
			</div>
			
				
			</form>
			
			
					
				
				
		
</div>





<?php
require_once('footer.php');
?>
