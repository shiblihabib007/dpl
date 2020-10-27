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
<div class="container">
<h4 class="text-center alert alert-info">All Expenses Categories!</h4>
<?php	
$sql_expense_category="SELECT * FROM expense_catagory ORDER BY item_creating_date ASC";
$result_expense = mysqli_query($conn, $sql_expense_category);
	if (mysqli_num_rows($result_expense) > 0) {
		?>
		<table class="table table-bordered">
    <thead>
      <tr>
        <th>SL</th>
        <th>Expense Categories</th>
        
        <th>Adding Date</th>
        
		
      </tr>
    </thead>
	<tbody>
		
		
		<?php
		$x=1;
		while($row_expense = mysqli_fetch_array($result_expense)){
				$id=$row_expense['id'];
				$expense_catagory_name=$row_expense['expense_catagory_name'];			
					
				$item_creating_date=$row_expense['item_creating_date'];	
				$timeStamp = date( "m/d/Y", strtotime($item_creating_date));						
			
						
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $expense_catagory_name;?></td>
					
					<td><?php echo $timeStamp;?></td>
					
				</tr> 
				
							
		<?php
			$x=$x+1;						
		}
			
			?>
			
						
						
						
						
						
						
						
						
						
						
				<?php		
						
					
					
		
			
	}
	else{
		?>
		<h4 class="text-center alert alert-warning ">There is no Expenses Category !</h4>
		
		
		
	<?php	
	}

	
			
			
		?>
		
		</tbody>
	  </table>	
		
		
		
	



<?php require 'footer.php';?>