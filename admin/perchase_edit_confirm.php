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
	
	
	$given_quantity=$_POST['qty'];
	$given_price=$_POST['item_price'];
		
		
		
	if(!empty($_POST['check_list']) ) {
		
		?>
		<form action="perchase_insert.php"  method="post" enctype="multipart/form-data">
		 <div class="form-group">
			<label for="exampleFormControlSelect1" >Bill No.</label>
			<input type="text" name="bill_no" class="form-control" value="<?php echo $_POST['bill_no']; ?>">
			</br>
			<label for="exampleFormControlSelect1">Select Supplier</label>
			<input type="text" name="supplier_full_name" class="form-control" value="<?php echo trim($_POST['supplier_company_name']); ?>">
			</br>
			<label for="fileToUpload">Insert Bill Scann Copy</label>
			<input type="file" name="fileToUpload" id="fileToUpload" required>
			
			
			
			
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
						<tbody>
						<?php
						$sl=1;
						$qty=0;
						
				

		$grand_total_quantity=0;
		$grand_total_price=0;	
		$sl=1;
		foreach($_POST['check_list'] as $id) {
			
			if($given_quantity[$id]==null or $given_price[$id]==null  ){
				
				$_SESSION["quantity_empty"]="Quantity or Price is Empty! Please give Quantity and Price carefully. ";
				header('Location:all_perchase_items.php');
				
				
			}
			
		
					
					?>
					  
						
						  <tr>
							<td><?php echo $sl;   ?></td>
							<td><input type="checkbox" name="check_list[]" style="display:none" value="<?php echo $id;?>" checked> <td>
			
							<td><?php echo trim($item_name);?></td>
							
							<td><input type="number" class="form-control" name="qty[<?php echo $row['id']; ?>]"  value="<?php echo $_POST['qty']["$id"];  ?>" required></td>
							<td><?php echo "pieces"; ?></td>
							<td><input type="number" class="form-control" name="item_price[<?php echo $row['id'];?>]"  value="<?php echo $_POST['item_price']["$id"];  ?>" required></td>
							
							<td><?php echo $total_price_by_item ; ?></td>
						  </tr>
						
						
					
					
					
					
						
<?php

			
		
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
		
		$_SESSION["quantity_empty"]="Item is not selected! please select carefully. ";
		header('Location:all_perchase_items.php');
	}
}	
?>
</div>			
<?php require 'footer.php';?>