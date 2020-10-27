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

	

	
	
	
$sql_purchase="SELECT * FROM accounts  WHERE acc_perchase_due > 0 ORDER BY acc_supplier_full_name DESC, acc_perchase_bill_no ASC ";
				$result_purchase = mysqli_query($conn, $sql_purchase);
			if (mysqli_num_rows($result_purchase) > 0) {
		
			
		?>
		
<h4 class="text-center alert alert-info ">Select Bill For Cash Recieve!</h4>
	<form action="bill_payment_cash.php" method="post">
	<div class="form-group col-md-3 col-md-offset-2">
		<label for="exampleFormControlSelect1" >Anount of Taka</label>
		<input type="text" name="amount_of_taka" class="form-control" value="" required >
		</br>
		<label for="exampleFormControlSelect1" >Recieve Type</label>
		</br>
		
					
				<select class="form-control" id="exampleFormControlSelect1" name="bank_cash_account" disabled>
				
					<option >CASH</option>
					
					
					
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
		while($purchase_data= mysqli_fetch_array($result_purchase)) {
			?>
	
   
      <tr>
	   <td><?php echo $x ;?></td>
	   
		<td><input type="checkbox" name="check_list[]"  value="<?php echo $purchase_data['acc_perchase_bill_no'];?>"> <td>
		
        <td><input type="text" value="<?php echo $purchase_data['acc_perchase_bill_no'];?>"> <td>
		<label for="supplier_name"></label>
		<td><input type="text"  name="supplier_name[]" value="<?php echo $purchase_data['acc_supplier_full_name'];?>"> <td>
		<td></td>
        <td><input type="text" name="due[]" value="<?php echo $purchase_data['acc_perchase_due'];?>"> <td>
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
	}else{
		
		?>
		
		<h4 class="text-center alert alert-danger ">There is no purchase to payment!</h4>
		
		<?php
		
		
	}
	
			
			?>
			
</div>

<?php require 'footer.php';?>