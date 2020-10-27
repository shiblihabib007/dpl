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

<h4 class="text-center heading-color">Edit Item</h4>
<?php 
if($_GET){
	$id=$_GET['id'];
	$_SESSION['item_id']=$id;
	$sql_items="SELECT * FROM items WHERE id='$id'";
	$result_items = mysqli_query($conn, $sql_items);
	if (mysqli_num_rows($result_items) > 0) {
		
		
	$row_items = mysqli_fetch_array($result_items);
	$id=$row_items['id'];
	$item_catagory_name=$row_items['item_catagory_name'];			
	$item_model_name=$row_items['item_model_name'];	
	
	$item_size=$row_items['item_size'];			
	$item_price=$row_items['item_price'];			
			
	$item_creating_date=$row_items['item_creating_date'];	
	$timeStamp = date( "m/d/Y", strtotime($item_creating_date));						
				
	$full_name=	$item_catagory_name.", ".$item_model_name;	
	



?>

		<form class="form-horizontal col-md-8 col-md-offset-2" action="edit_item_insert.php" method="POST">
	  <div class="form-group">
		<label for="item_catagory_name" class="col-sm-2 control-label">Item Catagory</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control text-capitalize" name="item_catagory_name" id="item_catagory_name" value="<?php echo $item_catagory_name; ?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="item_model_name" class="col-sm-2 control-label">Item Model</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" name="item_model_name" id="item_model_name" value="<?php echo $item_model_name; ?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="item_size" class="col-sm-2 control-label">Item Size</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" name="item_size" id="item_size" value="<?php echo $item_size; ?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="item_price" class="col-sm-2 control-label">Item Price</label>
		<div class="col-sm-10">
		  <input type="number" class="form-control" name="item_price" id="item_price" value="<?php echo $item_price; ?>">
		</div>
	  </div>
	  
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-default">Save</button>
		</div>
	  </div>
	</form>
<?php
	}else{
		?>
		<h4 class="text-center alert alert-warning">There is no items Item</h4>
		<?php
	}
	
}
	?>
</div>

<?php require 'footer.php';?>