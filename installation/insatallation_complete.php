<?php
$servername = "localhost";
$dbname="stdlog";
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
require_once('../header.php');
?>

<div class="container-fluid">

		<div class="alert alert-info text-center" role="alert">
		  <strong>Installation Successfuly Completed!</strong></br> Congratulations !!!
		</div>



		<div class="col-md-2 offset-md-10">
			<a href="../login.php">
				<button type="button" class="btn btn-primary btn-lg next">Let's Start</button>
			</a>
		</div>
</div>





<?php
require_once('../footer.php');
?>

