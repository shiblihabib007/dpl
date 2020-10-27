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
<h4 class="text-center alert alert-info">Confirm To Stock-Out!</h4>
<?php

if(isset($_POST['submit'])){
	
	
	$given_quantity=$_POST['qty'];
	
		
		
		
	if(!empty($_POST['check_list'] ) and  $_POST['check_list']!==null ) {
		
		?>
		<form action="stock_out_insert.php"  method="post" enctype="multipart/form-data">
		 
		<table class="table table-bordered">
						<thead>
						  <tr>
							<th>SL</th>
							<th></th>
							<th></th>
							
							<th>Items Description</th>
							
							<th>Available Quantity</th>
							<th>Stock-Out Quantity</th>
							
							
						  </tr>
						</thead>
						<?php
						$sl=1;
						$qty=0;
						
				
	
		foreach($_POST['check_list'] as $id) {
			
			if($given_quantity[$id]==null ){
				
				$_SESSION["quantity_empty"]="Quantity or Price is Empty! Please give Quantity and Price carefully. ";
				header('Location:all_available_stock.php');
				
				
			}
			
			$sql = "SELECT * FROM stocks WHERE id='$id'";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_array($result)) {
					$item_name=$row['stock_item_full_name'];
					$item_qty_db=$row['stock_item_amount'];
					$item_qty=$_POST['qty']["$id"];
					
					if($item_qty_db >= $item_qty){
					
					?>
					  
						<tbody>
						  <tr>
						   <td><?php echo $row['id'];?></td>
						   <td><input type="checkbox" name="check_list[]" style="display:none" value="<?php echo $id;?>" checked> <td>
							
							<td><?php echo trim($row['stock_item_full_name']); ?></td>
							
							<td><?php echo trim($row['stock_item_amount'])." ".$row['stock_item_unit']; ?></td>
							
							<td><input type="number" name="qty[<?php echo $row['id']; ?>]" class="form-control" value="<?php echo $item_qty; ?>" ></td>
							
							
						  </tr>     
											
						
					
					
					
					
						
<?php
					}else{
						$_SESSION["quantity_empty"]="Quantity is greater then available stock !";
				header('Location:all_available_stock.php');
						
					}
				}
				
				
			}
			
		
		$sl=$sl+1;	
		$qty=$qty+1;	
		}
		
		?>
		
			
		
		
			</tbody>
					  </table>
					   <button class="btn btn-default btn-primary" name="submit"> Confirm</button>
</form>
					  <?php
		
	}
	else{
		
		$_SESSION["quantity_empty"]="Item is not selected! please select carefully. ";
		header('Location:all_available_stock.php');
	}
}	
?>
</div>			
<?php require 'footer.php';?>