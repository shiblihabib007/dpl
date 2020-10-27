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

$_POST['grace_or_due']=null;
$_SESSION["final_list_of_purchase_bill_no"]=null;
$_SESSION["final_list_of_supplier_full_name"]=null;
$_SESSION["final_list_of_purchase_dues"]=null;
$_SESSION["final_payment_cheque_amount"]=null;
$_SESSION["total_purchase_dues"]=null;
$_SESSION["bank_acc_naumber"]=null;
$_SESSION["cheque_no"]=null;	

	
	
	
$sql_purchase="SELECT * FROM accounts  WHERE acc_perchase_due > 0 ORDER BY acc_supplier_full_name DESC, acc_perchase_bill_no ASC ";
				$result_purchase = mysqli_query($conn, $sql_purchase);
			if (mysqli_num_rows($result_purchase) > 0) {
		
			
		?>
		
<h4 class="text-center alert alert-info ">Select Bill For Cash Recieve!</h4>
	<form action="bill_payment_cheque.php" method="post">
	<div class="form-group col-md-3 col-md-offset-2">
		<label for="exampleFormControlSelect1"  >Cheque Number</label>
		<input type="text" name="cheque_no" class="form-control" value=""  required>
		</br>
		
		<label for="exampleFormControlSelect1" >Anount of Taka</label>
		<input type="text" name="amount_of_taka" class="form-control" value="" required >
		</br>
		<label for="exampleFormControlSelect1" >Bank Name</label>
		</br>
		<?php
			$sql_banks="SELECT * FROM banks";
			$resul_banks=mysqli_query($conn, $sql_banks);
			if (mysqli_num_rows($resul_banks) > 0) {
				
					?>
					
				<select class="form-control" id="exampleFormControlSelect1" name="account_number">
				<?php
					while($banks_data=mysqli_fetch_array($resul_banks)){
						$bank_id=$banks_data['id'];
						$bank_bank_name=$banks_data['bank_bank_name'];
						$bank_bank_account_number=$banks_data['bank_bank_account_number'];
						if($bank_bank_name !==null and $bank_bank_name!=="" ){
							
							
						
						?>
					<option value="<?php echo $bank_bank_account_number ; ?>"><?php echo $banks_data['bank_bank_name']." (Acc- ".$bank_bank_account_number." )" ;?></option>
					<?php
						}
					}
					?>
					
				</select>
				<?php
			}
			?>
					
			
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