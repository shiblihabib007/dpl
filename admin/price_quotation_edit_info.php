<?php
ob_start();
session_start();
if(isset($_SESSION["user"])){
	
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
}
if(isset($_GET)){
		
		$price_quotation_no=$_GET['price_quotation'];
		$client_name_get=$_GET['client_name'];
	}
?>
<?php require 'header.php';?>
<?php require 'nav.php';?>
<div class="container">

		<form action="price_quotation_update.php"  method="post">
		 <div class="form-group">
			<label for="exampleFormControlSelect1" >Price Quotation</label>
			<input type="text" name="quotation_no" class="form-control" value="<?php echo $price_quotation_no; ?>">
			
			<label for="exampleFormControlSelect1">Select Company</label>
			<input type="text" name="client_info" class="form-control" value="<?php echo $client_name_get; ?>">
			
			
			
			
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
							
							
						  </tr>
						</thead>
						<?php
						
					
						
				

				
	
			
					$sql_quotation_no_serch="SELECT * FROM operations WHERE quotation_no='$price_quotation_no'";
						$result_quotation_no_serch = mysqli_query($conn, $sql_quotation_no_serch);
						if (mysqli_num_rows($result_quotation_no_serch) > 0) {
							$total_rows=mysqli_num_rows($result_quotation_no_serch);
							$sl=1;
							while($row_quotation_no_serch = mysqli_fetch_array($result_quotation_no_serch)) {
							
								$item_id=$row_quotation_no_serch['item_id'];
								$item_full_name=$row_quotation_no_serch['item_full_name'];
								$item_qty=$row_quotation_no_serch['item_qty'];
								$item_price=$row_quotation_no_serch['item_price'];
			
								
					
					?>
					  
						<tbody>
						  <tr>
							<td><?php echo $sl;   ?></td>
							<td><input type="checkbox" name="check_list[]" style="display:none" value="<?php echo $item_id;?>" checked> <td>
			
							<td><?php echo $item_full_name;?></td>
							<td><?php echo "pieces"; ?></td>
							<td><input type="number" class="form-control" name="qty[<?php echo $item_id; ?>]"  value="<?php echo $item_qty;  ?>"></td>
							<td><input type="number" class="form-control" name="item_price[<?php echo $item_id;?>]"  value="<?php echo $item_price;  ?>"></td>
						  </tr>
						
						
					
					
					
					
						
<?php
						$sl=$sl+1;
						}
						}
				
		
		?>
		
	
		
		
			</tbody>
					  </table>
					   <button class="btn btn-default btn-primary " name="submit"> Save</button>
</form>
					  <?php
		
	
?>
</div>			
<?php require 'footer.php';?>