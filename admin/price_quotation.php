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
	foreach($_POST['company_name'] as $name) {
		$company_name=$name;
	}
			
	if(!empty($_POST['check_list'])) {
		
		?>
		<form action="price_quotation_insert.php"  method="post">
		 <div class="form-group">
			<label for="exampleFormControlSelect1" >Price Quotation</label>
			<input type="text" name="quotation_no" class="form-control" value="<?php echo $_POST['quotation_no']; ?>">
			
			<label for="exampleFormControlSelect1">Select Company</label>
			<input type="text" name="client_info" class="form-control" value="<?php echo $company_name; ?>">
			
			
			
			
		  </div>
		<table class="table table-bordered">
						<thead>
						  <tr>
							<th>SL</th>
							<th></th>
							<th></th>
							<th>Description</th>
							<th>Unit</th>
							<th>Qty</th>
							<th>Price</th>
							<th>Total</th>
							
							
						  </tr>
						</thead>
						<?php
						$sl=1;
						$qty=0;
						
				

		$grand_total_quantity=0;
		$grand_total_price=0;		
		foreach($_POST['check_list'] as $id) {
			
			
			$sql = "SELECT * FROM items WHERE id='$id'";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_array($result)) {
					$item_qty=$_POST['qty']["$id"];
					$item_price=$_POST['item_price']["$id"];
					
					$total_price_by_item=$item_qty *$item_price;
								$grand_total_price=$grand_total_price + $total_price_by_item;
					
					?>
					  
						<tbody>
						  <tr>
							<td><?php echo $sl;   ?></td>
							<td><input type="checkbox" name="check_list[]" style="display:none" value="<?php echo $id;?>" checked> <td>
			
							<td><?php echo trim($row['item_catagory_name']).", ". trim($row['item_model_name']).", Size: ". trim($row['item_size']);?></td>
							<td><?php echo "pieces"; ?></td>
							<td><input type="number" class="form-control" name="qty[<?php echo $row['id']; ?>]"  value="<?php echo $_POST['qty']["$id"];  ?>"></td>
							<td><input type="number" class="form-control" name="item_price[<?php echo $row['id'];?>]"  value="<?php echo $_POST['item_price']["$id"];  ?>"></td>
							<td><?php echo $total_price_by_item ; ?></td>
						  </tr>
						
						
					
					
					
					
						
<?php

				}
				
				
			}
			
		
		$sl=$sl+1;	
		$qty=$qty+1;	
		}
		
		?>
		
			<tr>
				<td></td>
				<td> <td>

				<td></td>
				<td></td>
				<td></td>
				<td>Grand Total: </td>
				<td><?php echo $grand_total_price ; ?></td>
				
			  </tr>
		
		
			</tbody>
					  </table>
					   <button class="btn btn-default btn-primary" name="submit"> Confirm</button>
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