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
<h4 class="text-center heading-color">Edit Existing Client or Party Info</h4>
		<?php 
if(isset($_SESSION["Success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["Success_msg"];?>
</div>


	
	<?php
	$_SESSION["Success_msg"]=NULL;
}
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$sql_client="SELECT * FROM clients WHERE id ='$id'";
	$result_client = mysqli_query($conn, $sql_client);
	if (mysqli_num_rows($result_client) > 0) {
		$row_client = mysqli_fetch_array($result_client);
			
						
				$id=$row_client['id'];
	$client_company=$row_client['client_company'];					
	$client_full_name=$row_client['client_full_name'];					
	$client_possition=$row_client['client_possition'];					
	$client_depertment=$row_client['client_depertment'];					
	$client_phone_no=$row_client['client_phone_no'];					
	$client_email=$row_client['client_email'];					
	$client_recievable_vat=$row_client['client_recievable_vat'];					
	$client_payable_vat=$row_client['client_payable_vat'];					
	$client_address_line_1=$row_client['client_address_line_1'];					
	$client_address_line_2=$row_client['client_address_line_2'];					
	$client_address_line_3=$row_client['client_address_line_3'];					
	
?>
	<form class="form-horizontal col-md-8 col-md-offset-1" action="client_info_update_insert.php?id=<?php echo $id; ?>" method="POST">
	  <div class="form-group">
		<label for="client_company" class="col-sm-4 control-label">New Company Name</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_company"  id="client_company" value="<?php echo $client_company ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_full_name" class="col-sm-4 control-label">Client Full Name</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_full_name" id="client_full_name" value="<?php echo $client_full_name ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_possition" class="col-sm-4 control-label">Rank Of Client</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_possition" id="client_possition" value="<?php echo $client_possition ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_depertment" class="col-sm-4 control-label">Depertment</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_depertment" id="client_depertment" value="<?php echo $client_depertment ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_phone_no" class="col-sm-4 control-label">Phone No.</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control " name="client_phone_no" id="client_phone_no" value="<?php echo $client_phone_no ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_email" class="col-sm-4 control-label">Email Address</label>
		<div class="col-sm-8">
		  <input type="email" class="form-control " name="client_email" id="client_email" value="<?php echo $client_email ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="recivable_vat" class="col-sm-4 control-label">Recievable VAT</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control " name="recivable_vat" id="recivable_vat" value="<?php echo $client_recievable_vat  ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="payable_vat" class="col-sm-4 control-label">Payable VAT</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control " name="payable_vat" id="payable_vat" value="<?php echo $client_payable_vat ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_address_line_1" class="col-sm-4 control-label">Address</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_address_line_1" id="client_address_line_1" value="<?php echo $client_address_line_1 ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_address_line_2" class="col-sm-4 control-label">Road No</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_address_line_2" id="client_address_line_2" value="<?php echo $client_address_line_2 ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<label for="client_address_line_3" class="col-sm-4 control-label">POST Code</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control text-capitalize" name="client_address_line_3" id="client_address_line_3" value="<?php echo $client_address_line_3 ;?>">
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-4 col-sm-4">
		  <button type="submit" class="btn btn-default" name="update">Update</button>
		</div>
	  </div>
	</form>
</div>
<?php
	}
}else{
	
	
}
?>
<?php require 'footer.php';?>