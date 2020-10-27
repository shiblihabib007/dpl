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

	
	
	
$sql="SELECT * FROM expenses WHERE expense_approve_status='approved' and expense_date BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	

	
		
	?>
<h4 class="text-center alert alert-success ">(All Expense)  during this period !</h4>
<div class="col-md-10 col-md-offset-1">
	<table class="table table-condensed table-responsive table-bordered ">
    <thead>
      <tr>
        <th>SL</th>
        <th>Expense Category </th>
        <th>Amount</th>
		<th>Narration</th>
        <th>Date</th>
      
		
		
        
		
        
		
      </tr>
    </thead>
	 <tbody>
<?php	
		
		
			
			$sql_expense_category="SELECT * FROM expense_catagory ORDER BY id ";
			$result_expense_category = mysqli_query($conn, $sql_expense_category);
			while($row_expense_category_data = mysqli_fetch_array($result_expense_category)) {
				$expense_catagory_name=$row_expense_category_data['expense_catagory_name'];
				
				$sql_expenses="SELECT * FROM expenses WHERE expense_approve_status='approved' and expense_catagory_name='$expense_catagory_name' and expense_date BETWEEN '$start_date' AND '$end_date'";
			$result_expenses= mysqli_query($conn, $sql_expenses);
					
				if (mysqli_num_rows($result_expenses) > 0) {
				$x=1;	
				while($result_expenses_data = mysqli_fetch_array($result_expenses)) {
				
				$expense_catagory_name=$result_expenses_data['expense_catagory_name'];
				$expense_amount=$result_expenses_data['expense_amount'];
				$expense_narration=$result_expenses_data['expense_narration'];
				$acc_transection_date=$result_expenses_data['expense_date'];
				$timeStamp = date( "m/d/Y", strtotime($acc_transection_date));
				

					 ?>
					
					 <tr>
					   <td><?php echo $x ;?></td>
					   <td><?php echo $expense_catagory_name ;?></td>
					   <td><?php echo $expense_amount ;?></td>
					   <td><?php echo $expense_narration ;?></td>
					 
					   <td><?php echo $timeStamp ;?></td>
					   
						
						
						
					  </tr>  


					
				<?php
				$x =$x +1; 
				}	
				
				}
					
				
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
<form action="report_expense.php" method="post">
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