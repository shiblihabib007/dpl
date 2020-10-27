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
if(isset($_GET['bill_no'])){
	$bill_number=$_GET['bill_no'];
	
}
$sql_bill_no="SELECT * FROM perchases WHERE parchase_bill_number='$bill_number'";
$result_bill = mysqli_query($conn, $sql_bill_no);


	if (mysqli_num_rows($result_bill) > 0) {
		
		
		?>
		<form action="perchase_edit_confirm.php" method="post">
		<div class="form-group col-md-6">
		<label for="exampleFormControlSelect1" >Bill No.</label>
			<input type="text" name="bill_no" class="form-control" value="<?php echo $bill_number; ?>" >
			<label for="exampleFormControlSelect1">Select Supplier</label>
			
			<select class="form-control" id="exampleFormControlSelect1" name="supplier_company_name">
			<?php
			$sql_supplier_info="SELECT * FROM suppliers";
				$result_supplier_info = mysqli_query($conn, $sql_supplier_info);
			if (mysqli_num_rows($result_supplier_info) > 0) {
		
		
				while($supplier_data= mysqli_fetch_array($result_supplier_info)) {
				$supplier_company=$supplier_data['supplier_company'];
				
					
				
				
				?>
		
		
				<option value="<?php echo $supplier_company;  ?>"><?php echo $supplier_company; ?></option>
		
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
   
		while($row = mysqli_fetch_array($result_bill)) {
			?>
	
    <tbody>
      <tr>
	   <td><?php echo $row['id'];?></td>
        <td><input type="checkbox" name="check_list[]" value="<?php echo $row['id'];?>"> <td>

       
		
		<td><input type="text" name="item_name[][<?php echo $row['id']; ?>]" class="form-control" value="<?php echo trim($row['parchase_item_name']);?>" ></td>
		<td><input type="number" name="qty[<?php echo $row['id']; ?>]" class="form-control" value="<?php echo $row['parchase_item_qty'] ;?>" ></td>
		<td><?php echo $row['parchase_item_unit']; ?></td>
        <td><input type="number" name="item_price[<?php echo $row['id'];?>]" class="form-control" value="<?php echo $row['parchase_item_price']; ?>" ></td>
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