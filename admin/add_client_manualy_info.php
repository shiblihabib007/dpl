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
<h4 class="text-center heading-color">Add New Client Or New Party</h4>
		<?php 
if(isset($_SESSION["Success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["Success_msg"];?>
</div>


	
	<?php
	$_SESSION["Success_msg"]=NULL;
}
?>
		<form class="form-horizontal col-md-8 col-md-offset-1" action="add_client_manualy_insert.php" method="POST">
	  <div class="form-group">
		<label for="client_company" class="col-sm-4 control-label">New Company Name</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_company"  id="client_company" placeholder="New Company Name">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_full_name" class="col-sm-4 control-label">Client Full Name</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_full_name" id="client_full_name" placeholder="Client Full Name">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_possition" class="col-sm-4 control-label">Rank Of Client</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_possition" id="client_possition" placeholder="Rank Of Client">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_depertment" class="col-sm-4 control-label">Depertment</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_depertment" id="client_depertment" placeholder="Depertment">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_phone_no" class="col-sm-4 control-label">Phone No.</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control " name="client_phone_no" id="client_phone_no" placeholder="Phone No">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_email" class="col-sm-4 control-label">Email Address</label>
		<div class="col-sm-8">
		  <input type="email" class="form-control " name="client_email" id="client_email" placeholder="Email Address">
		</div>
	  </div>
	  <div class="form-group">
		<label for="recivable_vat" class="col-sm-4 control-label">Recievable VAT</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control " name="recivable_vat" id="recivable_vat" placeholder="Recievable VAT">
		</div>
	  </div>
	  <div class="form-group">
		<label for="payable_vat" class="col-sm-4 control-label">Payable VAT</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control " name="payable_vat" id="payable_vat" placeholder="Payable VAT">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_address_line_1" class="col-sm-4 control-label">Address</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_address_line_1" id="client_address_line_1" placeholder="Address">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_address_line_2" class="col-sm-4 control-label">Road No</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_address_line_2" id="client_address_line_2" placeholder="Road No">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_address_line_3" class="col-sm-4 control-label">POST Code</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_address_line_3" id="client_address_line_3" placeholder="POST Code">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-4 col-sm-4">
		  <button type="submit" class="btn btn-default">Save</button>
		</div>
	  </div>
	</form>
</div>

<?php require 'footer.php';?>