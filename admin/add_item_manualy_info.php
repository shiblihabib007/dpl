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
		<h4 class="text-center heading-color">Add New Item</h4>
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
		<form class="form-horizontal col-md-8 col-md-offset-2" action="add_item_manualy_insert.php" method="POST">
	  <div class="form-group">
		<label for="item_catagory_name" class="col-sm-2 control-label">Item Catagory</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control text-capitalize" name="item_catagory_name" id="item_catagory_name" placeholder="Item Catagory">
		</div>
	  </div>
	  <div class="form-group">
		<label for="item_model_name" class="col-sm-2 control-label">Item Model</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" name="item_model_name" id="item_model_name" placeholder="Item Model">
		</div>
	  </div>
	  <div class="form-group">
		<label for="item_size" class="col-sm-2 control-label">Item Size</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" name="item_size" id="item_size" placeholder="Item Size">
		</div>
	  </div>
	  <div class="form-group">
		<label for="item_price" class="col-sm-2 control-label">Item Price</label>
		<div class="col-sm-10">
		  <input type="number" class="form-control" name="item_price" id="item_price" placeholder="Item Price">
		</div>
	  </div>
	  
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-default">Save</button>
		</div>
	  </div>
	</form>
</div>

<?php require 'footer.php';?>