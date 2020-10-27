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
<h4 class="text-center heading-color">Add New Supplier</h4>
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
		<form class="form-horizontal col-md-8 col-md-offset-1" action="add_supplier_manualy_insert.php" method="POST">
	  <div class="form-group">
		<label for="supplier_company" class="col-sm-4 control-label">New Supplier Company Name</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="supplier_company"  id="supplier_company" placeholder="New Company Name">
		</div>
	  </div>
	  <div class="form-group">
		<label for="supplier_full_name" class="col-sm-4 control-label">Supplier Full Name</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="supplier_full_name" id="supplier_full_name" placeholder="supplier Full Name">
		</div>
	  </div>
	  <div class="form-group">
		<label for="supplier_possition" class="col-sm-4 control-label">Rank Of Supplier</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="supplier_possition" id="supplier_possition" placeholder="Rank Of supplier">
		</div>
	  </div>
	  <div class="form-group">
		<label for="supplier_depertment" class="col-sm-4 control-label">Depertment</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="supplier_depertment" id="supplier_depertment" placeholder="Depertment">
		</div>
	  </div>
	  <div class="form-group">
		<label for="supplier_phone_no" class="col-sm-4 control-label">Phone No.</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control " name="supplier_phone_no" id="supplier_phone_no" placeholder="Phone No">
		</div>
	  </div>
	  <div class="form-group">
		<label for="supplier_email" class="col-sm-4 control-label">Email Address</label>
		<div class="col-sm-8">
		  <input type="email" class="form-control " name="supplier_email" id="supplier_email" placeholder="Email Address">
		</div>
	  </div>
	  <div class="form-group">
		<label for="supplier_address_line_1" class="col-sm-4 control-label">Address</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="supplier_address_line_1" id="supplier_address_line_1" placeholder="Address">
		</div>
	  </div>
	  <div class="form-group">
		<label for="supplier_address_line_2" class="col-sm-4 control-label">Road No</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="supplier_address_line_2" id="supplier_address_line_2" placeholder="Road No">
		</div>
	  </div>
	  <div class="form-group">
		<label for="supplier_address_line_3" class="col-sm-4 control-label">POST Code</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="supplier_address_line_3" id="supplier_address_line_3" placeholder="POST Code">
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