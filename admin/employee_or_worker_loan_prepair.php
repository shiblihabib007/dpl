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
	$_SESSION["employee_or_id"]=null;
	$_SESSION["wanted_loan_amount"]=null;
	$_SESSION["existing_loan"]=null;
	$_SESSION["basic_salary"]=null;	
	$_SESSION["current_balance"]=null;
	
	
	
		$wanted_loan_amount=trim($_POST['amount_of_taka']);
	
	?>
	
	<form action="employee_or_worker_loan_insert.php" method="post" enctype="multipart/form-data">
	<div class="form-group col-md-3 col-md-offset-1">
		<label for="exampleFormControlSelect1" >Anount of Taka</label>
		<input type="text" name="amount_of_taka" class="form-control" value="<?php echo $wanted_loan_amount;?>" disabled >
	</div>
	
	<div class="col-md-10 col-md-offset-1">

	<table class="table table-condensed table-responsive ">
    <thead>
      <tr>
        <th>SL</th>
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
	$employee_id= array();
	foreach($_POST['check_list'] as $id) {
	$employee_id[]=$id;
		
	
	
	
	}

	
	$employe_or_worker_numbers=sizeof($employee_id);
	

	
	if($employe_or_worker_numbers==1){
		$id=$id=$employee_id['0'];
		$sql_employee_or_worker="SELECT * FROM employee WHERE  	id='$id'";
			$result_employee = mysqli_query($conn, $sql_employee_or_worker);
			$employee_data=mysqli_fetch_array($result_employee);
			
			
			
		
		$employee_or_worker_name=$employee_data['employee_name'];
		$employee_or_worker_status=$employee_data['employee_status'];
		$employee_or_worker_basic_salary=$employee_data['employee_basic_salary'];
		$employee_or_worker_exsisting_loan=$employee_data['employee_loan'];
		$employee_or_worker_current_salary=$employee_or_worker_basic_salary - $employee_or_worker_exsisting_loan;
		
		
		
		
		
		
		if($employee_or_worker_current_salary < $wanted_loan_amount){
			
			
			//echo $employee_or_worker_current_salary."is > ".$wanted_loan_amount;
		//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "Cash amount is greater than your dues. You selected wrong Bill Numbers! Chose the correct Bill Numbers";
		//$_SESSION["error_msg"] = "Cash amount is greater than your dues. You selected wrong Bill Numbers! Chose the correct Bill Numbers";
		header('Location:all_employee_and_worker_loan.php');
		
		}
		if($employee_or_worker_current_salary >= $wanted_loan_amount){
			?>
			
	<tr>
	   <td><?php echo 1 ;?></td>
		<td><input type="text" name="" value="<?php echo $employee_or_worker_name;?>"> <td>
		<td><input type="text" name="" value="<?php echo $employee_or_worker_basic_salary;?>"> <td>
	
		<td><input type="text" name="" value="<?php echo $employee_or_worker_exsisting_loan;?>"> <td>
		
		<td><input type="text" name="" value="<?php echo $employee_or_worker_current_salary ;?>"> <td>
        
		
     </tr>   
			
		<?php
		}
	
	
	
	
	


?>

	<tr>
	   <td></td>
		<td><td>
		<td> <td>
	
		
		<td><b>Wanted Loan Amount= </b> <td>
		<td><?php echo $wanted_loan_amount;?><td>
        
		
     </tr> 
	 
	 
	 <tr>
	   <td></td>
		<td><td>
		<td> <td>
	
		
		<td><b>Current Balance After Loan=</b> <td>
		<td><input type="text" name="" value="<?php echo ($employee_or_worker_current_salary - $wanted_loan_amount);?>"> <td>
        
		
     </tr> 

	</tbody>
</table>

<button class="btn btn-default btn-primary" name="submit"> Confirm</button>


</div>	
<?php
	$_SESSION["employee_or_id"]=$id;
	$_SESSION["wanted_loan_amount"]=$wanted_loan_amount;
	$_SESSION["existing_loan"]=$employee_or_worker_exsisting_loan;
	$_SESSION["basic_salary"]=$employee_or_worker_basic_salary;	
	$_SESSION["current_balance"]=$employee_or_worker_basic_salary - $employee_or_worker_exsisting_loan;
}
else{
		//echo "You selected Different Customers! You should more careful about selecting Bill Number & Customer Names.";
		$_SESSION["error_msg"] = "You selected more than one Employee or Worker! You should more careful about selecting.";
		header('Location:all_employee_and_worker_loan.php');
		
	}

	

}
else{
	$_SESSION["error_msg"] = "Select Employee or Worker first, to do loan process !";
		header('Location:all_employee_and_worker_loan.php');
	
}
/*
 
	
		
 */
 


?>		
<?php require 'footer.php';?>