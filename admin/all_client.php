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
<h4 class="text-center alert alert-info">All Banks Info!</h4>
<?php	
$sql_client="SELECT * FROM clients ORDER BY client_adding_date ASC";
$result_client = mysqli_query($conn, $sql_client);
	if (mysqli_num_rows($result_client) > 0) {
		?>
		<table class="table table-bordered">
    <thead>
      <tr>
        <th>SL</th>
        <th>Buyer/Client Company Name</th>
        <th>Buyer/Client Full Name</th>
        <th>Designation</th>
        <th>Department</th>
        <th>Phone No.</th>
        <th>Email Address</th>
        <th>Vat Receivable From Client </th>
        <th>Vat Payable To Client </th>
        <th>Address</th>
        <th>Adding Date</th>
        
		
      </tr>
    </thead>
	<tbody>
		
		
		<?php
		$x=1;
		while($row_client = mysqli_fetch_array($result_client)){
				$id=$row_client['id'];
				$client_company=$row_client['client_company'];			
				$client_full_name=$row_client['client_full_name'];			
				$client_possition=$row_client['client_possition'];			
				$client_depertment=$row_client['client_depertment'];			
				$client_phone_no=$row_client['client_phone_no'];			
				$client_email=$row_client['client_email'];			
				$client_recievable_vat=$row_client['client_recievable_vat'];			
				$client_payable_vat=$row_client['client_payable_vat'];			
				$client_address_line_1=$row_client['client_address_line_1'];			
				$client_address_line_2=$row_client['client_address_line_2'];			
				$client_address_line_3=$row_client['client_address_line_3'];			
				$client_adding_date=$row_client['client_adding_date'];	

				
			$timeStamp = date( "m/d/Y", strtotime($client_adding_date));
							
				$full_address=$client_address_line_1.", ".$client_address_line_2.", ".$client_address_line_3;		
						
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $client_company;?></td>
					<td><?php echo $client_full_name;?></td>
					<td><?php echo $client_possition;?></td>
					<td><?php echo $client_depertment;?></td>
					<td><?php echo $client_phone_no;?></td>
					<td><?php echo $client_email;?></td>
					<td><?php echo $client_recievable_vat;?></td>
					<td><?php echo $client_payable_vat;?></td>
					<td><?php echo $full_address;?></td>
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
		<h4 class="text-center alert alert-warning ">There is no Buyer/Client !</h4>
		
		
		
	<?php	
	}

	
			
			
		?>
		
		</tbody>
	  </table>	
		
		
		
	



<?php require 'footer.php';?>