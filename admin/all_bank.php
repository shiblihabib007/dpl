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
<h4 class="text-center alert alert-info">All Bank Details!</h4>	
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
        <th>Acc. No.</th>
        <th>Branch Name</th>
        <th>Routing No.</th>
        <th>Balance</th>
       
        
		
      </tr>
    </thead>
	<tbody>
		
		
		<?php
		$x=1;
		while($row_banks = mysqli_fetch_array($result_banks)){
			
				$bank_bank_name=$row_banks['bank_bank_name'];	
				$bank_bank_account_number=$row_banks['bank_bank_account_number'];				
				$bank_bank_branch_name=$row_banks['bank_bank_branch_name'];			
							
				$bank_bank_routing_number=$row_banks['bank_bank_routing_number'];			
				$bank_bank_acc_balance=$row_banks['bank_bank_acc_balance'];			
				$bank_cash_balance=$row_banks['bank_cash_balance'];			
				$id=$row_banks['id'];			
							
				if($bank_bank_name=="" or $bank_bank_name==null){
				?>
					<tr>
						<td><?php echo $x;?></td>
						<td><?php echo "CASH" ;?></td>
						<td></td>
						<td></td>
						<td></td>
						
						<td><?php echo $bank_cash_balance ;?></td>
					</tr> 
					
				<?php	
				}else{	
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $bank_bank_name;?></td>
					<td><?php echo $bank_bank_account_number; ?></td>
					<td><?php echo $bank_bank_branch_name; ?></td>
					<td><?php echo $bank_bank_routing_number; ?></td>
					<td><?php echo $bank_bank_acc_balance; ?></td>
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
		<h4 class="text-center alert alert-warning ">There is no Banks!</h4>
		
		
		
	<?php	
	}

	
			
			
		?>
		
		</tbody>
	  </table>	
		
		
		
	



<?php require 'footer.php';?>