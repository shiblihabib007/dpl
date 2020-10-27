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
		<h4 class="text-center heading-color">Add Worker Info</h4>
		<?php 
if(isset($_SESSION["Success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <?php echo $_SESSION["Success_msg"];?>
</div>


	
	<?php
	$_SESSION["Success_msg"]=NULL;
}
?>
		<form class="form-horizontal col-md-6 col-md-offset-2" action="add_worker_manualy_insert.php" method="POST">
	  <div class="form-group">
		<label for="employee_full_name" class="col-sm-4 control-label">Worker Full Name</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="employee_full_name" id="employee_full_name" placeholder="Employee Full Name" required>
		</div>
	  </div>
	  <div class="form-group">
		<label for="basic_salary" class="col-sm-4 control-label">Basic Salary</label>
		<div class="col-sm-8">
		  <input type="number" class="form-control" name="basic_salary" id="basic_salary" placeholder="Basic Salary" required>
		</div>
	  </div>
	  
	  <div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
		  <button type="submit" class="btn btn-default">Save</button>
		</div>
	  </div>
	</form>
</div>

<?php require 'footer.php';?>