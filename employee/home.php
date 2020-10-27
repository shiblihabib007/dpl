<?php
session_start();
if(isset($_SESSION["user"])){
	if($_SESSION["user"]=="admin"){
		
		
		
		header('Location:../admin/home.php');
	}
}else{
	header('Location:../login.php');
}

?>
<?php require 'header.php';?>
<?php require 'nav.php';?>
<?php require 'footer.php';?>