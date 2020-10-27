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
			$sl=1;
			$qty=0;
			foreach($_POST['check_list'] as $id) {	
					$sql = "SELECT * FROM items WHERE id='$id'";
					$result = mysqli_query($conn, $sql);
					$data_item_id=array();
					$data_item_name=array();
					$data_item_qty=array();
					$data_item_price=array();
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_array($result)) {
							
									
							
								$item_id=$id;
								$item_full_name=trim($row['item_catagory_name']).", ". trim($row['item_model_name']).", Size: ". trim($row['item_size']);;
								$qty =$_POST['qty']["$id"];
								$price =$_POST['item_price']["$id"];
								$quotation_no=$_POST['quotation_no'];
								$company_name=$_POST['client_info'];
								
								
									$sql = "INSERT INTO operations (item_id, item_full_name, item_qty, item_price, client_name, quotation_no,work_oder_status)
									VALUES ($item_id,'$item_full_name',$qty, $price, '$company_name', $quotation_no,'pending')";
									
									

									if ($conn->query($sql) === TRUE) {
										$_SESSION["Success_msg"]="Quotation Is Successfully Created !";
										//header('refresh:3; url=price_quotation_insert.php');
										header('Location:home.php');
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}

							
								}
													
													
													
													
														


					}
								
							
				}
				$sl=$sl+1;	
				$qty=$qty+1;	
				
				
				
				
		}
		

		
	}
	else{
		header('Location:home.php');
	}
?>
</div>			
<?php require 'footer.php';?>