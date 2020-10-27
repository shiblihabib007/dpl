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
<h4 class="text-center alert alert-info ">Select (a Single) Employee or Worker for loan</h4>
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

	

	
	
	
$sql_employee="SELECT * FROM employee ORDER BY employee_name ASC";
				$result_employee = mysqli_query($conn, $sql_employee);
			if (mysqli_num_rows($result_employee) > 0) {
		
			
		?>
	<form action="employee_or_worker_loan_prepair.php" method="post">
	<div class="form-group col-md-3 col-md-offset-2">
		<label for="exampleFormControlSelect1" >Anount of Taka</label>
		<input type="text" name="amount_of_taka" class="form-control" value="" required >
			
	</div>
	
	<div class="col-md-8 col-md-offset-2">
	<table class="table table-condensed table-responsive ">
    <thead>
      <tr>
        <th>SL</th>
        <th>Select </th>
		<th></th>
        <th>Employee Name </th>
		<th></th>
		<th>Basic Salary</th>
		<th></th>
		<th>Existing Loan</th>
		<th></th>
		<th>Current Balance</th>
		
		
		
        
		
      </tr>
    </thead>
	 <tbody>
	<?php
		$x=1;
		while($employee_data= mysqli_fetch_array($result_employee)) {
			
			
			
			?>
	
   
      <tr>
	   <td><?php echo $x ;?></td>
	   
		<td><input type="checkbox" name="check_list[]"  value="<?php echo $employee_data['id'];?>"> <td>
		
        <td><input type="text" value="<?php echo $employee_data['employee_name'];?>"> <td>
        <td><input type="text" value="<?php echo $employee_data['employee_basic_salary'];?>"> <td>
		<td><input type="text" value="<?php echo $employee_data['employee_loan'];?>"> <td>
        <td><input type="text" value="<?php echo ($employee_data['employee_basic_salary'] - $employee_data['employee_loan']);?>"> <td>
        
		
		
		
        
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