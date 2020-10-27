<?php
ob_start();
session_start();
if(isset($_SESSION["user"])){
	
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
}
if(isset($_GET)){
		
		$purchase_bill_no=$_GET['purchase_bill_no'];
		$supplier_name=$_GET['supplier_name'];
	}
?>
<?php require 'header.php';?>
<?php require 'nav.php';?>
<div class="container">
<h4 class="text-center alert alert-info">Review for approve !</h4>
		<form action="purchase_approve_insert.php"  method="post">
		 <div class="form-group">
			<label for="exampleFormControlSelect1" >Purchase Internal Bill No.</label>
			<input type="text" name="purchase_bill_no" class="form-control" value="<?php echo $purchase_bill_no; ?>">
			</br>
			<label for="exampleFormControlSelect1">Supplier Name</label>
			<input type="text" name="supplier_info" class="form-control" value="<?php echo $supplier_name; ?>">
			
			
			
			
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
						
					
						
				

				
	
					$grand_total_quantity=0;
					$grand_total_price=0;
					$sql_purchase_bill_no_serch="SELECT * FROM perchases WHERE parchase_bill_number='$purchase_bill_no'";
						$result_purchase_no_serch = mysqli_query($conn, $sql_purchase_bill_no_serch);
						if (mysqli_num_rows($result_purchase_no_serch) > 0) {
							$total_rows=mysqli_num_rows($result_purchase_no_serch);
							$sl=1;
							while($row_purchase_no_serch = mysqli_fetch_array($result_purchase_no_serch)) {
							
								$item_id=$row_purchase_no_serch['id'];
								$item_full_name=$row_purchase_no_serch['parchase_item_name'];
								$item_qty=$row_purchase_no_serch['parchase_item_qty'];
								$item_price=$row_purchase_no_serch['parchase_item_price'];
			
								$grand_total_quantity=$grand_total_quantity+$item_qty;
								
								$total_price_by_item=$item_qty *$item_price;
								$grand_total_price=$grand_total_price + $total_price_by_item;
								
						
						?>
						  
							<tbody>
							  <tr>
								<td><?php echo $sl;   ?></td>
								<td><input type="checkbox" name="check_list[]" style="display:none" value="<?php echo $item_id;?>" checked> <td>
				
								<td><?php echo $item_full_name;?></td>
								<td><?php echo "pieces"; ?></td>
								<td><input type="number" class="form-control" name="qty[<?php echo $item_id; ?>]"  value="<?php echo $item_qty;  ?>"></td>
								<td><input type="number" class="form-control" name="item_price[<?php echo $item_id;?>]"  value="<?php echo $item_price;  ?>"></td>
								<td><?php echo $total_price_by_item ; ?></td>
								
							  </tr>
							
							
						
						
						
						
							
	<?php
							$sl=$sl+1;
							}
							
							$_SESSION['purchase_bill_no']=$purchase_bill_no;
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
					   <button class="btn btn-default btn-primary " name="submit"> Confirm</button>
</form>
					  <?php
		
	
?>
</div>			
<?php require 'footer.php';?>