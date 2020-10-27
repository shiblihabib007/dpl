<?php
ob_start();

session_start();
if(isset($_SESSION["user"])){
	
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
}

?>
<?php require 'header.php';?>
<?php require 'nav.php';?>
<div class="container">

<?php

if(isset($_POST['submit'])){
	
	if(!empty($_POST['check_list'])) {
		
		
			$stock_qty=0;
			foreach($_POST['check_list'] as $id) {	
					$sql = "SELECT * FROM stocks WHERE id='$id'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_array($result);
					$db_stock_qty=$row['stock_item_amount'];	
								
					$stock_qty	= $db_stock_qty - $item_qty=$_POST['qty']["$id"];
					
					$sql_stocks = "UPDATE stocks SET stock_item_amount='$stock_qty' WHERE id='$id'";	
					$conn->query($sql_stocks);
					
				}
					
				
				
			}
			$_SESSION["Success_msg"]="Stock-Out Successfully Completed !";
	
			header('Location:all_available_stock.php');
	}
	
	else{
		header('Location:home.php');
	}
?>
</div>			
<?php require 'footer.php';?>