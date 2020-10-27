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

		
			
	
$sql="SELECT * FROM reports WHERE report_transection_status='cheque deposit' and report_transection_date BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		
	?>
<h4 class="text-center alert alert-success ">Cheque Deposit Transactions during this period !</h4>
<div class="col-md-10 col-md-offset-1">
	<table class="table table-condensed table-responsive table-bordered ">
    <thead>
      <tr>
        <th>SL</th>
        <th>Transaction Type </th>
        <th>Bank Or Cash </th>
		<th>Old Balance</th>
        <th>Deposit</th>
        <th>Withdraw</th>
		<th>New Balance</th>
		
		
		<th>Date</th>
		
		
		
        
		
        
		
      </tr>
    </thead>
	 <tbody>
<?php	
		
			$x=1;
			while($row = mysqli_fetch_array($result)) {
			
			$report_transection_status=$row['report_transection_status'];
			$acc_transection_date=$row['report_transection_date'];
			$timeStamp = date( "m/d/Y", strtotime($acc_transection_date));
			

			if($report_transection_status=='cheque deposit'){
				 $report_bank_cash_or_cheque_withdraw_amount=$row['report_bank_cash_or_cheque_withdraw_amount'];
				 $report_cash_old_balance=$row['report_cash_old_balance'];
				 $report_cash_new_balance=$row['report_cash_new_balance'];
				 
				 ?>
				
				 <tr>
				   <td><?php echo $x ;?></td>
				   <td><?php echo $report_transection_status ;?></td>
				   <td><?php echo "CASH" ;?></td>
				   <td><?php echo $report_cash_old_balance ;?></td>
				   
				   <td><?php ?></td>
				   <td><?php echo $report_bank_cash_or_cheque_withdraw_amount;?></td>
				   <td><?php echo $report_cash_new_balance;?></td>
				   

				   
				   
				   <td><?php echo $timeStamp ;?></td>
				   
					
					
					
				  </tr>  


				
			<?php	 
			 }
			
			

			?>
		
	  <?php
			
			
		$x =$x +1;	 
		}
	
		
	}
	else{
		?>
		
		<h4 class="text-center alert alert-warning ">There is no purchase between this time duration !</h4>
	<?php
	}

}
?>
<h4 class="text-center alert alert-info ">Select Date to show (Cash/Cheque) (Deposit/Withdraw) report during a time period !</h4>
<form action="report_cheque_deposit.php" method="post">
	<div class="form-group col-md-2 col-md-offset-3">
		<label for="from_date" >Start Date </label>
		<input type="date" id="from_date" name="start_date" class="form-control" value="" required >
		
	</div>
	<div class="form-group col-md-2">
		<label for="to_date" >End Date </label>
		<input type="date" id="to_date" name="end_date" class="form-control" value="" required >
			
	</div>
	<div class="form-group col-md-2">
		<label for="to_date" ></label>
		<button class="btn btn-default btn-primary form-control" name="submit"> Submit</button>
			
	</div>

	
 
 
 
 </form>
  
  
  
  
</div>


<?php require 'footer.php';?>