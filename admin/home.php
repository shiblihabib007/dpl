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
if(isset($_SESSION["purchase_Success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["purchase_Success_msg"];?>
</div>


	
	<?php
	$_SESSION["purchase_Success_msg"]=NULL;
}
if(isset($_SESSION["Success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["Success_msg"];?>
</div>


	
	<?php
	$_SESSION["Success_msg"]=NULL;
}
if(isset($_SESSION["Cash_success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["Cash_success_msg"];?>
</div>


	
	<?php
	$_SESSION["Cash_success_msg"]=NULL;
}

if(isset($_SESSION["purchase_reject_msg"])){
	?>
	<div class="alert alert-danger text-center">
  <strong>Success!</strong> <?php echo $_SESSION["purchase_reject_msg"];?>
</div>


	
	<?php
	$_SESSION["purchase_reject_msg"]=NULL;
}
if(isset($_SESSION["reject_msg"])){
	?>
	<div class="alert alert-danger text-center">
  <strong>Success!</strong> <?php echo $_SESSION["reject_msg"];?>
</div>


	
	<?php
	$_SESSION["reject_msg"]=NULL;
}
if(isset($_SESSION["cash_success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["cash_success_msg"];?>
</div>


	
	<?php
	$_SESSION["cash_success_msg"]=NULL;
}

if(isset($_SESSION["error_msg"])){
	?>
	<div class="alert alert-warning text-center">
  <strong>Success!</strong> <?php echo $_SESSION["error_msg"];?>
</div>


	
	<?php
	$_SESSION["error_msg"]=NULL;
}

if(isset($_SESSION["cheque_upload_success"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["cheque_upload_success"];?>
</div>


	
	<?php
	$_SESSION["cheque_upload_success"]=NULL;
}
if(isset($_SESSION["cheque_success_msg"])){
	?>
	<div class="alert alert-success text-center">
  <strong>Success!</strong> <?php echo $_SESSION["cheque_success_msg"];?>
</div>


	
	<?php
	$_SESSION["cheque_success_msg"]=NULL;
}




?>
<?php require 'footer.php';?>