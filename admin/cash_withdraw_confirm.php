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
<h4 class="text-center alert alert-info  ">Confirm Cash Withdraw!</h4>
				

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

?>
<?php 


if(isset($_POST['submit'])){
	$_SESSION['amount']=null;
	
	$amount=$_POST['amount'];
	
	
	
}


?>
			<form class="form-horizontal col-md-8 col-md-offset-1" action="cash_withdraw_insert.php" method="POST">
			  <div class="form-group">
				<label for="amount" class="col-sm-4 control-label">Cash Amount</label>
				<div class="col-sm-8">
					<input type="text" name="amount" class="form-control text-capitalize" id="amount" onkeypress="return onlyAlphabets(event,this);" aria-describedby="emailHelp" value="<?php echo $amount; ?>" disabled>
				  </div>
			  </div>
			  
			  <div class="col-sm-6 control-label">
			  <button type="submit" name="submit" class="btn btn-info next">Withdraw</button>
			</div>
			
				
			</form>
			
			
					
				
				
		
</div>



<?php
$_SESSION['amount']=$amount;

?>

<?php
require_once('footer.php');
?>
