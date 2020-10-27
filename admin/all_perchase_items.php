<?php
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
<h4 class="text-center alert alert-info">Select For Purchase, You can change Qty & Price !</h4>

<?php
if(isset($_SESSION["error_msg"])){
	?>
	<div class="alert alert-danger text-center">
  <strong>Success!</strong> <?php echo $_SESSION["error_msg"];?>
</div>


	
	<?php
	$_SESSION["error_msg"]=NULL;
}
if(isset($_SESSION["quantity_empty"])){
	?>
	<h4 class="text-center alert alert-warning"><?php echo $_SESSION["quantity_empty"]; ?> </h4>
	
	
	<?php
	$_SESSION["quantity_empty"]=null;
}
 ?>
</h4>
<?php
$sql_bill_no="SELECT * FROM perchases ORDER BY id DESC LIMIT 1";
$result_bill = mysqli_query($conn, $sql_bill_no);


	if (mysqli_num_rows($result_bill) > 0) {
		$row_bill = mysqli_fetch_array($result_bill);
		$bill_no=$row_bill['parchase_bill_number'];
		
			$bill_no=$bill_no + 1;
		
		
		
		
	}
	if(!isset($bill_no)){
			$bill_no=01;
			
		}
	


	
	
	
 $sql = "SELECT * FROM perchase_items";
	$result = mysqli_query($conn, $sql);
	

	if (mysqli_num_rows($result) > 0) {
		
		
		?>
		<form action="perchase_confirm.php" method="post">
		<div class="form-group col-md-6">
		<label for="exampleFormControlSelect1" >Bill No.</label>
			<input type="text" name="bill_no" class="form-control" value="<?php echo $bill_no; ?>" >
			<label for="exampleFormControlSelect1">Select Supplier</label>
			
			<select class="form-control" id="exampleFormControlSelect1" name="supplier_company_name[]">
			<?php
			$sql_supplier_info="SELECT * FROM suppliers";
				$result_supplier_info = mysqli_query($conn, $sql_supplier_info);
			if (mysqli_num_rows($result_supplier_info) > 0) {
		
		
				while($supplier_data= mysqli_fetch_array($result_supplier_info)) {
				$supplier_company=$supplier_data['supplier_company'];
				
					
				
				
				?>
		
		
				<option><?php echo $supplier_company; ?></option>
		
			<?php
				}	
			}

			?>
			  
			  
			</select>
		</div>
	<table class="table">
    <thead>
      <tr>
        <th>SL</th>
        <th>Select</th>
        <th></th>
        <th>Items Description</th>
        
        <th>Item Qty</th>
		<th>Unit</th>
        <th>Item Price</th>
		
      </tr>
    </thead>
	<?php
   
		while($row = mysqli_fetch_array($result)) {
			?>
	
    <tbody>
      <tr>
	   <td><?php echo $row['id'];?></td>
        <td><input type="checkbox" name="check_list[]" value="<?php echo $row['id'];?>"> <td>
        <td><?php echo trim($row['perchase_item_full_name']); ?></td>
		
		<td><input type="number" name="qty[<?php echo $row['id']; ?>]" class="form-control" value="" ></td>
		<td><?php echo $row['perchase_item_unit']; ?></td>
        <td><input type="number" name="item_price[<?php echo $row['id'];?>]" class="form-control" value="" ></td>
      </tr>      
      
    
			
			
			<?php
			
		}
		?>
		</tbody>
  </table>
  <button class="btn btn-default btn-primary" name="submit"> Submit</button>
</form>
  <?php
	}
	
			
			?>
			
</div>

<?php require 'footer.php';?>