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
<div class="container  ">
<h4 class="text-center alert alert-info ">Select Bill For Cash Recieve!</h4>
<?php 
if(isset($_SESSION["error_msg"])){
?>	
	<h4 class="text-center heading-color alert alert-warning">
	<?php echo $_SESSION["error_msg"]; ?>
	
	</h4>;
	<?php
	$_SESSION["error_msg"]=null;
	
}
if(isset($_SESSION["success_msg"])){
?>	
	<h4 class="text-center alert alert-success">
	<?php echo $_SESSION["success_msg"]; ?>
	
	</h4>;
	<?php
	
	$_SESSION["success_msg"]=null;
	
}

?>


<?php

	

	
	
	
$sql_bill_list="SELECT * FROM accounts  WHERE acc_bill_due > 0 ORDER BY acc_company_full_name DESC, acc_sale_bill_no ASC ";
				$result_bill = mysqli_query($conn, $sql_bill_list);
			if (mysqli_num_rows($result_bill) > 0) {
		
			
		?>
	<form action="bill_recieve_cash.php" method="post">
	<div class="form-group col-md-3 col-md-offset-2">
		<label for="exampleFormControlSelect1" >Anount of Taka</label>
		<input type="text" name="amount_of_taka" class="form-control" value="" required >
		</br>
		<label for="exampleFormControlSelect1" >Recieve Type</label>
		</br>
		
					
				<select class="form-control" id="exampleFormControlSelect1" name="account_number" disabled>
				
					<option >CASH</option>
					
					?>
					
				</select>
					
			
	</div>
	
	<div class="col-md-8 col-md-offset-2">
	<table class="table table-condensed table-responsive ">
    <thead>
      <tr>
        <th>SL</th>
        <th>Select </th>
		<th></th>
        <th>Bill No.</th>
		<th></th>
		<th>Client Name</th>
		
		<th></th>
		<th></th>
		<th>Total Due</th>
        
		
        
		
      </tr>
    </thead>
	 <tbody>
	<?php
		$x=1;
		while($company_data= mysqli_fetch_array($result_bill)) {
			?>
	
   
      <tr>
	   <td><?php echo $x ;?></td>
	   
		<td><input type="checkbox" name="check_list[]"  value="<?php echo $company_data['acc_sale_bill_no'];?>"> <td>
		
        <td><input type="text" value="<?php echo $company_data['acc_sale_bill_no'];?>"> <td>
		<label for="company_name"></label>
		<td><input type="text"  name="company_name[]" value="<?php echo $company_data['acc_company_full_name'];?>"> <td>
		<td></td>
        <td><input type="text" name="due[]" value="<?php echo $company_data['acc_bill_due'];?>"> <td>
		<td></td>
		
        
      </tr>      
      
    
			
			
			<?php
		$x =$x +1;	
		}
		
		?>
		</tbody>
  </table>
  <button class="btn btn-default btn-primary" name="submit"> Submit</button>
  </div>
  
</form>
  <?php
	}
	
			
			?>
			
</div>

<?php require 'footer.php';?>