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
	
	
	

	$sth = $conn->prepare("SELECT * FROM user where user_username='admin'");
	$data=$sth->execute();
	$result = $sth->fetchAll();
	$row=count($result);
	
	if($row==1){
		header('Location:student_table_config.php');
	}
	else{
		
		}
	


	
	
require_once('header.php');
?>

<div class="container-fluid">
		
		<div class="alert alert-info text-center" role="alert">
		  <strong>Admin Panel Settings!</strong></br> Please, Fillup This Very Carefuly And Confidentialy </br>
		</div>
		<div class="col-md-8 offset-md-2">
			<form action="admin_info_insert.php" method="POST">
			  <div class="form-group">
				<label for="exampleInputEmail1">Full Name</label>
				<input type="text" name="user_full_name" class="form-control text-capitalize" id="exampleInputEmail1" onkeypress="return onlyAlphabets(event,this);" aria-describedby="emailHelp" placeholder="Full Name" required>
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
				<label for="exampleInputEmail1">Username</label>
				<input type="text" name="user_username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="admin" disabled >
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" name="user_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  </div>
				<div class="form-group">
				<label for="exampleInputEmail1">User Status</label>
				<input type="text" name="user_status" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="admin" disabled >
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

