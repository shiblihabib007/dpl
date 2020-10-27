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
		
		?>
		<form action="price_quotation_insert.php" class="new_tab" method="post">
		<table class="table table-bordered">
						<thead>
						  <tr>
							<th>SL</th>
							<th>Description</th>
							<th>Unit</th>
							<th>Qty</th>
							<th>Price</th>
						  </tr>
						</thead>
						<?php
						$sl=1;
						$qty=0;
						
				$item_id=array();

				
		foreach($_POST['check_list'] as $id) {
			$item_id[]=$id;
			$item_qty[]=$_POST['qty']["$id"]; 
			
			$sql = "SELECT * FROM items WHERE id='$id'";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_array($result)) {
					
					?>
					  
						<tbody>
						  <tr>
							<td><?php echo $sl;   ?></td>
							<td><input type="checkbox" name="check_list[]" value="<?php echo $id;?>"> <td>
							<td><input type="text" name="check_list[]" value="<?php echo $id;?>"> <td>
							<td><?php echo trim($row['item_catagory_name']).", ". trim($row['item_model_name']).", ". trim($row['item_model_name']).", Size: ". trim($row['item_size']);?></td>
							<td><?php echo "pieces"; ?></td>
							<td><input type="number" class="form-control"  value="<?php echo $item_qty["$qty"]; ?>"></td>
							<td><input type="number" class="form-control" value="<?php echo $row['item_price']; ?>"></td>
						  </tr>
						
						
					
					
					
					
						
<?php

				}
				
				
			}
			
		
		$sl=$sl+1;	
		$qty=$qty+1;	
		}
		$_SESSION["item_id"]=$item_id;
		$_SESSION["item_qty"]=$item_qty;
		?>
		
	
		
		
			</tbody>
					  </table>
					   <button class="login-button" name="submit"> Submit</button>
</form>
					  <?php
		
	}
	else{
		header('Location:all_items.php');
	}
}	
?>
</div>			
<?php require 'footer.php';?>