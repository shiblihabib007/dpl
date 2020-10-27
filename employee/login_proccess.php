<?php require 'auth.php';
session_start();
if(isset($_POST['login'])){

	$username=$_POST['username'];
	$password=$_POST['password'];
	
	
	
	$sql = "SELECT * FROM user WHERE user_username='$username'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
   
		while($row = mysqli_fetch_array($result)) {
			$db_username=$row['user_username'];
			$db_password=$row['user_password'];
	   

			if (password_verify("$password", $db_password)) {
				if($user_status=="admin"){
					header('Location:admin/home.php');
				}
				elseif($user_status=="employee"){
					header('Location:employee/home.php');
					
				}
			} else {
				echo 'Invalid password.';
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