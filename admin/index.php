<?php require 'auth.php';
session_start();
if(isset($_SESSION["user"])){
	if($_SESSION["user"]=="admin"){
		
		
		
		header('Location:home.php');
	}
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
}

if(isset($_POST['login'])){

	$username=$_POST['username'];
	$password=$_POST['password'];
	
	
	
	$sql = "SELECT * FROM user WHERE admin_username='$username'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
   
		while($row = mysqli_fetch_array($result)) {
			$row['admin_username'];
			$row['admin_pass'];
	   

			
			
			if($username==$row['admin_username']){
				if($password==$row['admin_pass']){
					$_SESSION["admin_username"] = $row['admin_username'];
					
					header('Location:home.php');

				}
				else{
					header('Location:index.php');
				}
			}
		}

	}
}else{
	header('Location:login.php');
}






?>