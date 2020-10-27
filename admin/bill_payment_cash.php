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
	$_SESSION["final_list_of_purchase_bill_no"]=null;
	$_SESSION["final_list_of_supplier_full_name"]=null;
	$_SESSION["final_list_of_purchase_dues"]=null;
	$_SESSION["final_payment_cash_amount"]=	null;
	$_SESSION["total_purchase_dues"]=null;
	$amount_of_taka_of_cash=trim($_POST['amount_of_taka']);
	
	

	?>
	
	<form action="bill_payment_insert_cash.php" method="post" enctype="multipart/form-data">
	<div class="form-group col-md-3 col-md-offset-2">
		<label for="exampleFormControlSelect1" >Anount of Taka</label>
		<input type="text" name="amount_of_taka" class="form-control" value="<?php echo $amount_of_taka_of_cash;?>" disabled >
		</br>
		<label for="exampleFormControlSelect1" >Recieve Type</label>
		</br>
		
					
				<select class="form-control" id="exampleFormControlSelect1" name="bank_cash_account" disabled>
				
					<option >CASH</option>
					
					?>
					
				</select>
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
        <td><input type="text" name="amount_of_cash" value="<?php echo $amount_of_taka_of_cash;?>"> <td>
		
		
       
		<td></td>
		
        
      </tr> 
	  
	  
		<?php
		if($amount_of_taka_of_cash < $total_purchase_dues){
			$grace_or_amount= $total_purchase_dues - $amount_of_taka_of_cash;
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
if($amount_of_taka_of_cash < $total_purchase_dues){
	
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
	
	
	
	
	
	
	
	
	
	$_SESSION["final_list_of_purchase_bill_no"]=$bill_numbers;
	$_SESSION["final_list_of_supplier_full_name"]=$supplier_full_name;
	$_SESSION["final_list_of_purchase_dues"]=$due_per_purchase_bill;
	$_SESSION["final_payment_cash_amount"]=$amount_of_taka_of_cash;
	$_SESSION["total_purchase_dues"]=$total_purchase_dues;
	
	
	


?>
</div>	
<?php
 if($company_numbers>=2){
		//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "You selected Different Suppliers! You should more careful about selecting Bill Number & supplier Names.";
		header('Location:all_purchase_for_bill_payment_cash.php');
		
	}
	if($amount_of_taka_of_cash > $total_purchase_dues){
		//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "Cash amount is greater than your dues. You selected wrong Bill Numbers! Chose the correct Bill Numbers";
		header('Location:all_purchase_for_bill_payment_cash.php');
		
	}
		
 
 
}
else{
	$_SESSION["error_msg"] = "Select Bills first, to go next step !";
		header('Location:all_purchase_for_bill_payment_cash.php');
	
}
?>		
<?php require 'footer.php';?>