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
		<h4 class="text-center heading-color">Add New Bill Field</h4>
		<?php 
if(isset($_SESSION["Success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["Success_msg"];?>
</div>


	
	<?php
	$_SESSION["Success_msg"]=NULL;
}
if(isset($_SESSION["error_msg"])){
	?>
	<div class="alert alert-danger text-center">
  <strong>Success!</strong> <?php echo $_SESSION["error_msg"];?>
</div>


	
	<?php
	$_SESSION["error_msg"]=NULL;
}
?>
		<form class="form-horizontal col-md-8 col-md-offset-1" action="add_bill_field_manualy_insert.php" method="POST">
	  <div class="form-group">
		<label for="bill_field_name" class="col-sm-4 control-label">Bill Name</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="bill_field_name" id="bill_field_name" placeholder="Perchase Item Full Name" autofocus>
		</div>
	  </div>
	  
	  
	  
	  <div class="form-group">
		<div class="col-sm-offset-4 col-sm-10">
		  <button type="submit" class="btn btn-default" name="submit">Submit</button>
		</div>
	  </div>
	</form>
</div>

<?php require 'footer.php';?>