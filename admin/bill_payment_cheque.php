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
if(isset($_POST['submit']) and isset($_POST['check_list'])){
	
	
	
	
	
	$bank_account_number=$_POST['account_number'];
	
	
	
	$_SESSION["final_list_of_purchase_bill_no"]=null;
	$_SESSION["final_list_of_supplier_full_name"]=null;
	$_SESSION["final_list_of_purchase_dues"]=null;
	$_SESSION["final_payment_cheque_amount"]=	null;
	$_SESSION["total_purchase_dues"]=null;
	$amount_of_taka_of_cheque=trim($_POST['amount_of_taka']);
	$_SESSION["bank_acc_naumber"]=null;
	$_SESSION["cheque_no"]=null;
	

	?>
	
	<form action="bill_payment_insert_cheque.php" method="post" enctype="multipart/form-data">
	<div class="form-group col-md-3 col-md-offset-2">
		<label for="exampleFormControlSelect1"  >Cheque Number</label>
		<input type="text" name="cheque_no" class="form-control" value="<?php echo $_POST['cheque_no'];?>"  disabled>
		
		<label for="exampleFormControlSelect1" >Anount of Taka</label>
		<input type="text" name="amount_of_taka" class="form-control" value="<?php echo $amount_of_taka_of_cheque;?>" disabled >
		</br>
		<select class="form-control" id="exampleFormControlSelect1" name="account_numbeer" disabled>
			<?php
			$sql_banks="SELECT * FROM banks WHERE bank_bank_account_number='$bank_account_number'";
				$result_bank_info = mysqli_query($conn, $sql_banks);
			if (mysqli_num_rows($result_bank_info) > 0) {
		
		
				$bank_data= mysqli_fetch_array($result_bank_info);
				$bank_name=$bank_data['bank_bank_name'];
				$acc_bank_account_number=$bank_data['bank_bank_account_number'];
				$acc_bank_acc_balance=$bank_data['bank_bank_acc_balance'];
				
				
				
				
				
				
				?>
				
		
				<option value="<?php echo trim($acc_bank_account_number);  ?>"><?php echo $bank_name." ( Acc No: ".$acc_bank_account_number." )"; ?></option>
		
			<?php
				}
			?>
			  
			  
			</select>
			</br>
			<input type="file" name="fileToUpload" id="fileToUpload" required>
	</div>
	
	<div class="col-md-8 col-md-offset-2">

	<table class="table table-condensed table-responsive ">
    <thead>
      <tr>
        <th>SL</th>
        
		<th></th>
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
	$purchase_bill_numbers= array();
	foreach($_POST['check_list'] as $id1) {
	$purchase_bill_numbers[]=$id1;
		
	
	
	
	$sql_purchase_bill_list="SELECT * FROM accounts WHERE acc_perchase_bill_no='$id1'";
				$result_purchase_bill = mysqli_query($conn, $sql_purchase_bill_list);
			$row1=mysqli_fetch_array($result_purchase_bill);
			
			
			
			
			$due_per_purchase_bill[]=$row1['acc_perchase_due'];
	
	
	}
	
	
	
	
	$bill_numbers= array();
	$supplier_full_name= array();
	$due_per_purchase_bill= array();
	
	
	$x=0;
	foreach($_POST['check_list'] as $id) {
	$bill_numbers[]=$id;
		
	$x=$x+1;
	
	
	$sql_purchase_bill_list="SELECT * FROM accounts WHERE acc_perchase_bill_no='$id'";
				$result_bill = mysqli_query($conn, $sql_purchase_bill_list);
			$row=mysqli_fetch_array($result_bill);
			
			$supplier_full_name[]=$row['acc_supplier_full_name'];
			$supplier_full_name_for_disec[]=$row['acc_supplier_full_name'];
			
			
			$due_per_purchase_bill[]=$row['acc_perchase_due'];
			
	
	$total_purchase_dues=array_sum($due_per_purchase_bill);
	
	

	//print_r($bill_numbers);
	
	
	$unique_comapany1=array_unique($supplier_full_name);
	
	$supplier_full_name_disec[]=krsort($supplier_full_name_for_disec);
	$unique_comapany_disec=array_unique($supplier_full_name_for_disec);
	$company_numbers=array_count_values($unique_comapany1);
	
	$company_numbers=sizeof($unique_comapany1);
	//$total_purchase_dues=array_sum($due_per_purchase_bill);
	//var_dump($company_numbers);
	
	if($company_numbers<=1){
		
	
		
			?>
	
	
      <tr>
	   <td><?php echo $x ;?></td>
		<td><input type="checkbox" name="check_list[]" style="display:none" value="<?php echo $id;?>"checked> <td>
		
        <td><input type="text" value="<?php echo $id;?>"> <td>
		<td><input type="text" name="supplier_name[]" value="<?php echo $row['acc_supplier_full_name'];?>"> <td>
		<td></td>
        <td><input type="text" name="due[]" value="<?php echo $row['acc_perchase_due'];?>"> <td>
		
		<td></td>
		
        
      </tr>      
      
    
			
			
	<?php
		
	//echo "--------------------------";
	//print_r($due_per_purchase_bill);
	
	//echo $total_purchase_dues;
	//echo "--------------------------";
	}
		
	}	
		?>
		<tr>
	   <td></td>
		<td> <td>
		
        <td><td>
		<td><td>
		<td><b>Total=</b></td>
        <td><input type="text" name="total_purchase_dues" value="<?php echo $total_purchase_dues;?>"> <td>
		
		
       
		<td></td>
		
        
      </tr>
	
	  <tr>
	   <td></td>
		<td> <td>
		
        <td><td>
		<td><td>
		<td><b>Cash Payment =</b></td>
        <td><input type="text" name="amount_of_cash" value="<?php echo $amount_of_taka_of_cheque;?>"> <td>
		
		
       
		<td></td>
		
        
      </tr> 
	  
	  
		<?php
		if($amount_of_taka_of_cheque < $total_purchase_dues){
			$grace_or_amount= $total_purchase_dues - $amount_of_taka_of_cheque;
			?>
			<tr>
	   <td></td>
		<td> <td>
		
        <td><td>
		<td><td>
		<td ><b>grace / Due Amount=</b></td>
			<td><input type="text" name="grace_or_due_amount" value="<?php echo $grace_or_amount;?>"> <td>
			<td></td>
		</tr>
		
		
		
		
		
		
	   
		
        
		
			
			

	
	
		<?php	
		}
		?>
	  
		</tbody>
  </table>

<?php 
if($amount_of_taka_of_cheque < $total_purchase_dues){
	
?>


<div class="radio">
  <label><input type="radio" name="grace_or_due" Value="grace" checked>Grace Applicable</label>
</div>

<div class="radio">

  <label><input type="radio" name="grace_or_due" value="due" >Keeping This Due</label>
</div>
</br>
 <?php
 
 }

?>
  <button class="btn btn-default btn-primary" name="submit"> Confirm</button>
  </div>

</form>
	
	<?php
	
	
	
	
	
	
	
	
	$_SESSION["cheque_no"]=$_POST['cheque_no'];
	$_SESSION["final_list_of_purchase_bill_no"]=$bill_numbers;
	$_SESSION["final_list_of_supplier_full_name"]=$supplier_full_name;
	$_SESSION["final_list_of_purchase_dues"]=$due_per_purchase_bill;
	$_SESSION["final_payment_cheque_amount"]=$amount_of_taka_of_cheque;
	$_SESSION["total_purchase_dues"]=$total_purchase_dues;
	$_SESSION["bank_acc_naumber"]=trim($acc_bank_account_number);
	
	
	
	


?>
</div>	
<?php
if($acc_bank_acc_balance < $amount_of_taka_of_cheque){
	//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "Your Cheque amount is greater then your bank balance";
		header('Location:all_purchase_for_bill_payment_cheque.php');
	
}

 if($company_numbers>=2){
		//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "You selected Different Suppliers! You should more careful about selecting Bill Number & supplier Names.";
		header('Location:all_purchase_for_bill_payment_cheque.php');
		
	}
	if($amount_of_taka_of_cheque > $total_purchase_dues){
		//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "Cheque amount is greater than your dues. You selected wrong Bill Numbers! Chose the correct Bill Numbers";
		header('Location:all_purchase_for_bill_payment_cheque.php');
		
	}
		
 
 
}
else{
	$_SESSION["error_msg"] = "Select Bills first, to go next step !";
		header('Location:all_purchase_for_bill_payment_cheque.php');
	
}
?>		
<?php require 'footer.php';?>