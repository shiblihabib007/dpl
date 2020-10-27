<?php require 'auth.php';
session_start();
if(isset($_POST['login'])){
	$_SESSION["clicked"]="clicked";
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	
	
	
	$sql = "SELECT * FROM user WHERE user_username='$username'";
	$result = mysqli_query($conn, $sql);
	if($result!==true){
		$_SESSION["msg"] = "UserName Or PassWord is incorrect! Try again.";
				header('Location:login.php');
		
	}

	if (mysqli_num_rows($result) > 0) {
   
		while($row = mysqli_fetch_array($result)) {
			$db_username=$row['user_username'];
			$db_password=$row['user_password'];
			$user_status=$row['user_status'];
			
	   
			
			if (isset($db_username)  & password_verify("$password", $db_password)) {
				if($user_status=="employee"){
					$_SESSION["user"] = "employee";
					header('Location:employee/home.php');
					
				}
				if($user_status=="admin"){
					$_SESSION["user"] = "admin";
					
					
					header('Location:admin/home.php');
				}
				
			} else {
				$_SESSION["msg"] = "UserName Or PassWord is incorrect! Try again.";
				header('Location:login.php');
			}
			/*
			if($username==$row['admin_username']){
				if($password==$row['admin_pass']){
					$_SESSION["admin_username"] = $row['admin_username'];
					
					header('Location:home.php');

				}
				else{
					header('Location:index.php');
				}
			}
			*/
		}

	}
}else{
	header('Location:index.php');
}






?>