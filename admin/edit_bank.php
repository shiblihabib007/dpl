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
<h4 class="text-center alert alert-info">Edit Bank Info!</h4>	
<?php	
$sql_banks="SELECT * FROM banks ORDER BY bank_bank_name ASC";
$result_banks = mysqli_query($conn, $sql_banks);
	if (mysqli_num_rows($result_banks) > 0) {
		?>
		<table class="table table-bordered">
    <thead>
      <tr>
        <th>SL</th>
        <th>Bank Full Name</th>
        <th>Action</th>
        
		
      </tr>
    </thead>
	<tbody>
		
		
		<?php
		$x=1;
		while($row_banks = mysqli_fetch_array($result_banks)){
			
				$bank_bank_name=$row_banks['bank_bank_name'];			
				$id=$row_banks['id'];			
							
				if($bank_bank_name=="" or $bank_bank_name==null){
				?>
					<tr>
						<td><?php echo $x;?></td>
						<td><?php echo "CASH";?></td>
						<td>Read-Only</td>
					</tr> 
					
				<?php	
				}else{	
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $bank_bank_name;?></td>
					<td><a href="bank_edit_info.php?id=<?php echo $id; ?>">Edit</a></td>
				</tr> 
				
							
		<?php
				}
			$x=$x+1;						
		}
			
			?>
			
						
						
						
						
						
						
						
						
						
						
				<?php		
						
					
					
		
			
	}
	else{
		?>
		<h4 class="text-center alert alert-warning ">There is no Banks !</h4>
		
		
		
	<?php	
	}

	
			
			
		?>
		
		</tbody>
	  </table>	
		
		
		
	



<?php require 'footer.php';?>