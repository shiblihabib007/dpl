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
<h4 class="text-center alert alert-info">Edit Client Info!</h4>	
<?php	
$sql_client="SELECT * FROM clients ORDER BY client_company ASC";
$result_client = mysqli_query($conn, $sql_client);
	if (mysqli_num_rows($result_client) > 0) {
		?>
		<table class="table table-bordered">
    <thead>
      <tr>
        <th>SL</th>
        <th>Client/Buyer Full Name</th>
        <th>Action</th>
        
		
      </tr>
    </thead>
	<tbody>
		
		
		<?php
		$x=1;
		while($row_client = mysqli_fetch_array($result_client)){
			
				$client_company=$row_client['client_company'];			
				$id=$row_client['id'];			
							
						
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $client_company;?></td>
					<td><a href="client_edit_info.php?id=<?php echo $id; ?>">Edit</a></td>
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