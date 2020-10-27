<?php
session_start();
if(isset($_SESSION["user"])){
	if($_SESSION["user"]=="admin"){
		
		
		
		header('Location:admin/home.php');
	}
	if($_SESSION["user"]=="employee"){
		
		header('Location:employee/home.php');
		
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="icon" href="images/title.png">
  <title>DPL System</title>
  <link rel="stylesheet" href="bootstrap-3.3.7/css/login-style.css">
 
</head>
<body>

<div class="login">
  <div class="login-header">
    <h1 style="color:#CC3300">Admin</h1>

  </div>
  <div class="login-form">
	
  <form method="post" action="login_proccess.php">
    <h3>Username:</h3>
    <input type="text"   name="username" placeholder="Username"/><br>
    <h3>Password:</h3>
    <input type="password" name="password" placeholder="Password"/>
    <br>
	 <br>
    <button class="login-button" name="login"> Login</button>
	 <br>
	 <br>
	
    <?php
		if(isset($_SESSION["msg"]) & isset($_SESSION["clicked"])){
			?>
			
			<h3 style="color:red"><?php echo $_SESSION["msg"]; ?></h3>
		<?php
		
		}
		session_destroy();
	?>
  
    
    <!--<h6 class="no-access">Can't access your account?</h6>-->
    </form>
  </div>
</div>
    
    <!--log end-->
    
    
    
</body>
</html>