<?php
$servername = "localhost";
$dbname="dbdpl";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    //echo "Connection failed: " . $e->getMessage();
	//header('Location:installation/creating_database.php');
    }
	

	
require_once('header.php');
?>

<div class="container-fluid">
		
		<div class="alert alert-info text-center" role="alert">
		  <strong>Company Info Panel Settings!</strong></br> Please, Fillup This Very Carefuly</br>
		</div>
		<div class="col-md-8 offset-md-2">
			<form action="company_info_insert.php" method="POST">
			  <div class="form-group">
				<label for="companyFullName">Company Full Name</label>
				<input type="text" name="company_full_name" class="form-control text-capitalize" id="companyFullName" onkeypress="return onlyAlphabets(event,this);" aria-describedby="emailHelp" placeholder="Company Full Name" required>
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
				<label for="exampleInputEmail1">Company Title</label>
				<input type="text" name="company_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Company Title" required>
			  </div>
			  
				<div class="form-group">
				<label for="exampleInputEmail1">address Line 1</label>
				<input type="text" name="address_line_1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address Line 1" required>
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">address Line 2</label>
				<input type="text" name="address_line_2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address Line 2" required>
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">address Line 3</label>
				<input type="text" name="address_line_3" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address Line 3" required>
			  </div>
			  <div class="col-md-2 offset-md-10">
			  <button type="submit" class="btn btn-primary next">Next</button>
			</div>
			
				
			</form>
			
			
					
				
				
		</div>
</div>





<?php
require_once('footer.php');
?>

