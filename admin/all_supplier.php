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
<h4 class="text-center alert alert-info">All Suppliers Info!</h4>
<?php	
$sql_client="SELECT * FROM suppliers ORDER BY supplier_adding_date ASC";
$result_client = mysqli_query($conn, $sql_client);
	if (mysqli_num_rows($result_client) > 0) {
		?>
		<table class="table table-bordered">
    <thead>
      <tr>
        <th>SL</th>
        <th>Supplier company Name</th>
        <th>Supplier Full Name</th>
        <th>Designation</th>
        <th>Department</th>
        <th>Phone No.</th>
        <th>Email Address</th>
        
        <th>Address</th>
        <th>Adding Date</th>
        
		
      </tr>
    </thead>
	<tbody>
		
		
		<?php
		$x=1;
		while($row_client = mysqli_fetch_array($result_client)){
				$id=$row_client['id'];
				$supplier_company=$row_client['supplier_company'];			
				$supplier_full_name=$row_client['supplier_full_name'];			
				$supplier_possition=$row_client['supplier_possition'];			
				$supplier_depertment=$row_client['supplier_depertment'];			
				$supplier_phone_no=$row_client['supplier_phone_no'];			
				$supplier_email=$row_client['supplier_email'];			
						
				$supplier_address_line_1=$row_client['supplier_address_line_1'];			
				$supplier_address_line_2=$row_client['supplier_address_line_2'];			
				$supplier_address_line_3=$row_client['supplier_address_line_3'];			
				$supplier_adding_date=$row_client['supplier_adding_date'];	
				$timeStamp = date( "m/d/Y", strtotime($supplier_adding_date));						
							
				$full_address=$supplier_address_line_1.", ".$supplier_address_line_2.", ".$supplier_address_line_3;		
						
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $supplier_company;?></td>
					<td><?php echo $supplier_full_name;?></td>
					<td><?php echo $supplier_possition;?></td>
					<td><?php echo $supplier_depertment;?></td>
					<td><?php echo $supplier_phone_no;?></td>
					<td><?php echo $supplier_email;?></td>
					
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