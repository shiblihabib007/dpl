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
	<h4 class="text-center heading-color">Add a CASH-BOX to system !</h4>				

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
$sql="SELECT * FROM banks WHERE bank_cash_account='CASH'";
				$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result)>0) {
				$_SESSION["success_msg"]="CASH-BOX already exist, You can add new bank! ";	
			header('Location:add_bank_to_system.php');
			
			
			}
?>

			<form class="form-horizontal col-md-8 col-md-offset-1" action="cash_box_insert.php" method="POST">
			  <div class="form-group">
				<label for="bank_full_name" class="col-sm-4 control-label">Bank Full Name</label>
				<div class="col-sm-8">
					<input type="text" name="bank_full_name" class="form-control text-capitalize" id="bank_full_name" onkeypress="return onlyAlphabets(event,this);" aria-describedby="emailHelp" value="CASH" required>
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
			 
			  <div class="col-sm-6 control-label">
			  <button type="submit" name="submit" class="btn btn-primary next">Add Now</button>
			</div>
			
				
			</form>
			
			
					
				
				
		
</div>





<?php
require_once('footer.php');
?>
