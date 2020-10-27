<?php
$servername = "localhost";
$dbname="dbdpl";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if($conn==true){
		header('Location:admin_table_config.php');
	}
	
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
		  <strong>Database Configaration Begains.!</strong></br>Follow this instructions to complete installation proccess.
		</div>



		<div class="col-md-2 offset-md-10">
			<a href="creating_database.php">
				<button type="button" class="btn btn-primary btn-lg next">Next</button>
			</a>
		</div>
</div>





<?php
require_once('footer.php');
?>

