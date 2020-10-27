<?php require 'auth.php';
session_start();
if(isset($_SESSION["user"])){
	if($_SESSION["user"]=="admin"){
		
		
		
		header('Location:admin/home.php');
	}
	if($_SESSION["user"]=="employee"){
		
		header('Location:employee/home.php');
		
	}
}else{
	header('Location:login.php');
}
?>