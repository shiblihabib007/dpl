<?php
ob_start();
session_start();
if(isset($_SESSION["user"])){
	
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
}
require 'header.php';
require 'nav.php';
?>

<div class="container">
<?php
if(isset($_POST['submit'])){
	
	$start_date=$_POST['start_date']." 00:00:00";
	$end_date=$_POST['end_date']." 23:59:59";

	
	
	
$sql="SELECT * FROM accounts
WHERE acc_bill_credit_method='cheque' and  acc_transection_date BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		
	?>
<div class="col-md-10 col-md-offset-1">
	<table class="table table-condensed table-responsive table-bordered ">
    <thead>
      <tr>
        <th>SL</th>
        <th>Bill No. </th>
		<th>Buyer Company Name</th>
        <th>Total Price</th>
		<th>Total Credit</th>
		<th>Total Due</th>
		<th>Total Grace</th>
		<th>Date</th>
		
		
        
		
        
		
      </tr>
    </thead>
	 <tbody>
<?php	 
		
		$x=1;
		while($row = mysqli_fetch_array($result)) {
			$acc_sale_bill_no=$row['acc_sale_bill_no']; 
			$acc_company_full_name=$row['acc_company_full_name']; 
			$acc_item_price_in_total=$row['acc_item_price_in_total']; 
			$acc_bill_credit=$row['acc_bill_credit']; 
			$acc_bill_due=$row['acc_bill_due']; 
			$acc_bill_grace=$row['acc_bill_grace'];
			$acc_transection_date=$row['acc_transection_date'];
			$timeStamp = date( "m/d/Y", strtotime($acc_transection_date));
			
			

			?>
		 <tr>
	   <td><?php echo $x ;?></td>
	   <td><?php echo $acc_sale_bill_no ;?></td>
	   <td><?php echo $acc_company_full_name ;?></td>
	   <td><?php echo $acc_item_price_in_total ;?></td>
	   <td><?php if($acc_bill_credit)echo $acc_bill_credit ;?></td>
	   <td><?php if($acc_bill_due)echo $acc_bill_due ;?></td>
	   <td><?php if($acc_bill_grace)echo $acc_bill_grace ;?></td>
	   <td><?php echo $timeStamp ;?></td>
	   
		
		
        
      </tr>  
	  <?php
			
			
		$x =$x +1;	 
		}
	}
	else{
		
		echo "no";
	}

}
?>

<form action="test.php" method="post">
	<div class="form-group col-md-3 col-md-offset-2">
		<label for="from_date" >From Date </label>
		<input type="date" id="from_date" name="start_date" class="form-control" value="" required >
		
		</br>
		<label for="to_date" >To Date </label>
		<input type="date" id="to_date" name="end_date" class="form-control" value="" required >
			
	</br>
 <button class="btn btn-default btn-primary" name="submit"> Submit</button>
 
 </div>
 </form>
  
  
  
  
</div>


<?php require 'footer.php';?>