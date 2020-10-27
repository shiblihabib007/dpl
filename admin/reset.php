<?php
session_start();

if(isset($_SESSION["user"])){
	
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
	
	
}else{
	header('Location:../login.php');
}

?>
<?php require 'header.php';?>
<?php require 'nav.php';?>
<?php
$sql_accounts = "TRUNCATE TABLE accounts";
   mysqli_query($conn,$sql_accounts);
   
$sql_operations = "TRUNCATE TABLE  operations ";
   mysqli_query($conn,$sql_operations);
 
 $sql_reports = "TRUNCATE TABLE  reports ";
   mysqli_query($conn,$sql_reports);
   
   
   $sql_perchases = "TRUNCATE TABLE  perchases ";
   mysqli_query($conn,$sql_perchases);



?>
<?php require 'footer.php';?>