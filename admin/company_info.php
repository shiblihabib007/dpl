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
<?php
$sql = "SELECT * FROM company";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
   
		while($row = mysqli_fetch_array($result)) {
			$company_full_name=$row['company_full_name'];
			$company_title=$row['company_title'];
			$address_line_1 =$row['address_line_1'];
			$address_line_2 =$row['address_line_2'];
			$address_line_3 =$row['address_line_3'];
		}
	}
?>


<div class="container-fluid">
		
		<h4 class="text-center heading-color">Company Detals, You Can Change Some Informations !</h4>
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
			<form class="form-horizontal col-md-8 col-md-offset-1" action="company_info_update.php" method="POST">
			  <div class="form-group">
				<label for="companyFullName" class="col-sm-4 control-label">Company Full Name</label>
				<div class="col-sm-8">
					<input type="text" name="company_full_name" class="form-control text-capitalize" id="companyFullName" onkeypress="return onlyAlphabets(event,this);" aria-describedby="emailHelp" value="<?php echo $company_full_name ;?>" disabled>
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
				<label for="exampleInputEmail1" class="col-sm-4 control-label">Company Title</label>
				<div class="col-sm-8">
				<input type="text" name="company_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $company_title ;?>"  disabled>
			  </div>
			  </div>
			  
				<div class="form-group">
				<label for="exampleInputEmail1" class="col-sm-4 control-label">address Line 1</label>
				<div class="col-sm-8">
				<input type="text" name="address_line_1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $address_line_1 ;?>" required>
			  </div>
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1" class="col-sm-4 control-label">address Line 2</label>
				<div class="col-sm-8">
				<input type="text" name="address_line_2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $address_line_2 ;?>" required>
			  </div>
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1" class="col-sm-4 control-label">address Line 3</label>
				<div class="col-sm-8">
				<input type="text" name="address_line_3" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $address_line_3 ;?>" required>
			  </div>
			  </div>
			  <div class="col-sm-6 control-label">
			  <button type="submit" class="btn btn-primary next">Update Now</button>
			</div>
			
				
			</form>
			
			
					
				
				
		
</div>





<?php
require_once('footer.php');
?>