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
<h4 class="text-center heading-color">Select For Creating Price Quotation, You can change Qty & Price !</h4>
<h3>
<?php
if(isset($_SESSION["submit"])){
	echo "Quantity is Empty! Please give Quantity. ";
}
 ?>
</h3>
<?php
$sql_quotation_no="SELECT * FROM operations ORDER BY id DESC LIMIT 1";
$result_quotation = mysqli_query($conn, $sql_quotation_no);


	if (mysqli_num_rows($result_quotation) > 0) {
		$row_quotation = mysqli_fetch_array($result_quotation);
		$quotation_no=$row_quotation['quotation_no'];
		
			$quotation_no=$quotation_no + 1;
		
		
		
		
	}
	if(!isset($quotation_no)){
			$quotation_no=000001;
			
		}
	


	
	
	
 $sql = "SELECT * FROM items";
	$result = mysqli_query($conn, $sql);
	

	if (mysqli_num_rows($result) > 0) {
		
		
		?>
		<form action="price_quotation.php" method="post">
		<div class="form-group col-md-6">
		<label for="exampleFormControlSelect1" >Price Quotation</label>
			<input type="text" name="quotation_no" class="form-control" value="<?php echo $quotation_no; ?>" >
			<label for="exampleFormControlSelect1">Select Company</label>
			
			<select class="form-control" id="exampleFormControlSelect1" name="company_name[]">
			<?php
			$sql_company_info="SELECT * FROM clients";
				$result_company_info = mysqli_query($conn, $sql_company_info);
			if (mysqli_num_rows($result_company_info) > 0) {
		
		
				while($company_data= mysqli_fetch_array($result_company_info)) {
				$company_name=$company_data['client_company'];
				
					$company_name=$company_data['client_company'];
				
				
				?>
		
		
				<option><?php echo $company_name; ?></option>
		
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
        <th>Unit</th>
        <th>Item Qty</th>
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
        <td><?php echo trim($row['item_catagory_name']).", ". trim($row['item_model_name']).", Size: ". trim($row['item_size']); ?></td>
		<td>Pieces</td>
		<td><input type="number" name="qty[<?php echo $row['id']; ?>]" class="form-control" value="60" ></td>
        <td><input type="number" name="item_price[<?php echo $row['id'];?>]" class="form-control" value="<?php echo $row['item_price']; ?>"></td>
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