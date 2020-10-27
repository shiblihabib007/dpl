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
	$_SESSION["final_list_of_bill_no"]=null;
	$_SESSION["final_list_of_company_full_name"]=null;
	$_SESSION["final_list_of_dues"]=null;
	
	$_SESSION["final_cash_amount"]=	null;
	$_SESSION["total_dues"]=null;
	
	
	
	$amount_of_taka_of_cash=trim($_POST['amount_of_taka']);
	
	
	
	$_SESSION["net_vat"]=null;
	$_SESSION["grand_total_after_adjust_vat"]=null;
	$_SESSION["grace_or_due"]=null;
	
	$_SESSION["vat_per_bill_from_client_list"]=null;
	
	$_SESSION["vat_per_bill_from_client_list_after_adjust"]=null;
	$_SESSION["vat_per_bill_to_client_list"]=null;
	

	//$bank_account_number=trim($_POST['account_number']);
	
	
	
	
	
	
	
	
	
	
	
	?>
	
	<form action="bill_recieve_insert_cash.php" method="post" enctype="multipart/form-data">
	<div class="form-group col-md-3 col-md-offset-2">
		<label for="exampleFormControlSelect1" >Anount of Taka</label>
		<input type="text" name="amount_of_taka" class="form-control" value="<?php echo $amount_of_taka_of_cash;?>" disabled >
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
	$bill_numbers1= array();
	foreach($_POST['check_list'] as $id1) {
	$bill_numbers1[]=$id1;
		
	
	
	
	$sql_bill_list1="SELECT * FROM accounts WHERE acc_sale_bill_no='$id1'";
				$result_bill1 = mysqli_query($conn, $sql_bill_list1);
			$row1=mysqli_fetch_array($result_bill1);
			
			
			
			
			$due_per_bill1[]=$row1['acc_bill_due'];
	
	
	}
	
	
	
	
	$bill_numbers= array();
	$company_full_name= array();
	$due_per_bill= array();
	
	$vat_per_bill_given_by_client= array();
	$vat_per_bill_client_wanted= array();
	$acc_bill_due_vat_adjusted=array();
	$x=0;
	foreach($_POST['check_list'] as $id) {
	$bill_numbers[]=$id;
		
	$x=$x+1;
	
	
	$sql_bill_list="SELECT * FROM accounts WHERE acc_sale_bill_no='$id'";
				$result_bill = mysqli_query($conn, $sql_bill_list);
			$row=mysqli_fetch_array($result_bill);
			
			$company_full_name[]=$row['acc_company_full_name'];
			$company_full_name_for_disec[]=$row['acc_company_full_name'];
			
			
			$due_per_bill[]=$row['acc_bill_due'];
			
	
	$total_dues1=array_sum($due_per_bill1);
	
	
	$vat_per_bill_given_by_client[]=$row['acc_bill_due_vat'];
		$acc_bill_due_vat_adjusted[]=$row['acc_bill_due_vat_adjusted'];
			$vat_per_bill_client_wanted[]=$row['acc_bill_reducable_by_client_vat'];
	
	
	//print_r($bill_numbers);
	$total_vat_given_by_client=	array_sum($vat_per_bill_given_by_client);
	$total_vat_wanted_by_client=array_sum($vat_per_bill_client_wanted);
	$net_vat=array_sum($acc_bill_due_vat_adjusted);
			
	
	$total_due_after_count_both_vat= $total_dues1 + $net_vat;
	
	
	
	$unique_comapany1=array_unique($company_full_name);
	
	$company_full_name_disec[]=krsort($company_full_name_for_disec);
	$unique_comapany_disec=array_unique($company_full_name_for_disec);
	$company_numbers=array_count_values($unique_comapany1);
	
	$company_numbers=sizeof($unique_comapany1);
	//$total_dues=array_sum($due_per_bill);
	//var_dump($company_numbers);
	
	if($company_numbers<=1){
		
	
		
			?>
	
	
      <tr>
	   <td><?php echo $x ;?></td>
		<td><input type="checkbox" name="check_list[]" style="display:none" value="<?php echo $id;?>"checked> <td>
		
        <td><input type="text" value="<?php echo $id;?>"> <td>
		<td><input type="text" name="company_name[]" value="<?php echo $row['acc_company_full_name'];?>"> <td>
		<td></td>
        <td><input type="text" name="due[]" value="<?php echo $row['acc_bill_due'];?>"> <td>
		
		<td></td>
		
        
      </tr>      
      
    
			
			
	<?php
		
	//echo "--------------------------";
	//print_r($due_per_bill);
	
	//echo $total_dues;
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
        <td><input type="text" name="due[]" value="<?php echo $total_dues1;?>"> <td>
		
		
       
		<td></td>
		
        
      </tr>
	<tr>
			<td></td>
			<td> <td>
			<td><td>
			<td><td>
			<td><b>VAT(15%)=</b></td>
			<td><input type="text" name="total_vat" value="<?php echo $total_vat_given_by_client;?>"> <td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td> <td>
			<td><td>
			<td><td>
			<td><b>Return VAT(4.5%)=</b></td>
			<td><input type="text" name="total_vat" value="<?php echo $total_vat_wanted_by_client;?>"> <td>
			<td></td>
		</tr>
		
		<tr>
			<td></td>
			<td> <td>
			<td><td>
			<td><td>
			<td><b>Net VAT=</b></td>
			<td><input type="text" name="total_vat" value="<?php echo $net_vat;?>"> <td>
			<td></td>
		</tr>
		
		<tr>
			<td></td>
			<td> <td>
			<td><td>
			<td><td>
			<td><b>Grand Total=</b></td>
			<td><input type="text" name="grand_total" value="<?php echo $total_due_after_count_both_vat;?>"> <td>
			<td></td>
		</tr>
	  <tr>
	   <td></td>
		<td> <td>
		
        <td><td>
		<td><td>
		<td><b>Cash Receive =</b></td>
        <td><input type="text" name="due[]" value="<?php echo $amount_of_taka_of_cash;?>"> <td>
		
		
       
		<td></td>
		
        
      </tr> 
	  
	  
		<?php
		if($amount_of_taka_of_cash < $total_due_after_count_both_vat){
			$grace_amount= $total_due_after_count_both_vat - $amount_of_taka_of_cash;
			?>
			<tr>
	   <td></td>
		<td> <td>
		
        <td><td>
		<td><td>
		<td ><b>grace / Due Amount=</b></td>
			<td><input type="text" name="due[]" value="<?php echo $grace_amount;?>"> <td>
			<td></td>
		</tr>
		
		
		
		
		
		
	   
		
        
		
			
			

	
	
		<?php	
		}
		?>
	  
		</tbody>
  </table>

<?php 
if($amount_of_taka_of_cash < $total_due_after_count_both_vat){
	
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
	
	
	$_SESSION["final_list_of_bill_no"]=$bill_numbers;
	$_SESSION["final_list_of_company_full_name"]=$company_full_name;
	$_SESSION["final_list_of_dues"]=$due_per_bill;
	$_SESSION["final_cash_amount"]=$amount_of_taka_of_cash;	
	$_SESSION["total_dues"]=$total_dues1;	


	$_SESSION["grand_total_after_adjust_vat"]=$total_due_after_count_both_vat;
	$_SESSION["vat_per_bill_from_client_list"]=$vat_per_bill_given_by_client;
	$_SESSION["vat_per_bill_to_client_list"]=$vat_per_bill_client_wanted;
	$_SESSION["vat_per_bill_from_client_list_after_adjust"]=$acc_bill_due_vat_adjusted;
	
	
	$vat_per_bill_given_by_client_adjusted=$_SESSION["vat_per_bill_from_client_list_after_adjust"];
	$vat_per_bill_client_wanted=$_SESSION["vat_per_bill_to_client_list"];	
	


?>
</div>	
<?php
 if($company_numbers>=2){
		//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		header('Location:all_Items_for_bill_recieve_cash.php');
		
	}
	if($amount_of_taka_of_cash > $total_due_after_count_both_vat){
		//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "Cash amount is greater than your dues. You selected wrong Bill Numbers! Chose the correct Bill Numbers";
		header('Location:all_Items_for_bill_recieve_cash.php');
		
	}
		
 
 
}
else{
	$_SESSION["error_msg"] = "Select Bills first, to go next step !";
		header('Location:all_Items_for_bill_recieve_cash.php');
	
}
?>		
<?php require 'footer.php';?>