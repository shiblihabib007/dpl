<?php
session_start();
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
	header('Location:installation/database_config.php');
    }
	
if($_POST){
	try {

		$stmt = $conn->prepare("INSERT INTO employee (employee_name,employee_status,employee_basic_salary) VALUES (?, ?, ?)");
		
		$stmt->bindParam(1, $employee_name);
		$stmt->bindParam(2, $employee_status);
		$stmt->bindParam(3, $employee_basic_salary);
		
		// insert one row
		$employee_name = ucwords($_POST['employee_full_name']);
		$employee_status = "worker";
		$employee_basic_salary = $_POST['basic_salary'];
		
		$stmt->execute();
		$_SESSION["Success_msg"]="worker Is Successfully Added !";
		//echo $_SESSION["Success_msg"];
		} 
		catch (PDOException $e) {
			echo "The user could not be added.<br>".$e->getMessage();
		}
	
}
	header('Location:add_worker_manualy_info.php');	
	
	
	
