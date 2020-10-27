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
	<h4 class="text-center heading-color">Add a New Bank to system !</h4>				

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

			<form class="form-horizontal col-md-8 col-md-offset-1" action="bank_info_insert.php" method="POST">
			  <div class="form-group">
				<label for="bank_full_name" class="col-sm-4 control-label">Bank Full Name</label>
				<div class="col-sm-8">
					<input type="text" name="bank_full_name" class="form-control text-capitalize" id="bank_full_name" onkeypress="return onlyAlphabets(event,this);" aria-describedby="emailHelp" placeholder="Bank Full Name" required>
				  </div>
			  </div>
			  <script language="Javascript" type="text/javascript">
										function onlyAlphabets(e, t) {
											try {
												if (window.event) {
													var charCode = window.event.keyCode;
													}
													else if (e) {
														var charCode = e.which;
													}
													else { return true; }
													
													if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode==8) || (charCode==32) )
														return true;
													else
														return false;
											}		
											catch (err) {
													alert(err.Description );
											}			
										}

									</script>
			  <div class="form-group">
				<label for="account_number" class="col-sm-4 control-label" >Account Number</label>
				<div class="col-sm-8">
				<input type="number" name="account_number" class="form-control" id="account_number" aria-describedby="emailHelp" placeholder="Account Number" required>
			  </div>
			  </div>
			  
				<div class="form-group">
				<label for="routing_number" class="col-sm-4 control-label">Routing Number</label>
				<div class="col-sm-8">
				<input type="number" name="routing_number" class="form-control" id="routing_number" aria-describedby="emailHelp" placeholder="Routing Number" required>
			  </div>
			  </div>
			  <div class="form-group">
				<label for="branch_name" class="col-sm-4 control-label">Branch Name</label>
				<div class="col-sm-8">
				<input type="text" name="branch_name" class="form-control text-capitalize" id="branch_name" aria-describedby="emailHelp" placeholder="Branch Name" required>
			  </div>
			  </div>
			 
			  <div class="col-sm-6 control-label">
			  <button type="submit" name="submit" class="btn btn-primary next">Add Now</button>
			</div>
			
				
			</form>
			
			
					
				
				
		
</div>





<?php
require_once('footer.php');
?>
