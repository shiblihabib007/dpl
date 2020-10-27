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


	
<?php	
$sql_quotation_no="SELECT * FROM operations WHERE work_oder_status='pending' ORDER BY id DESC LIMIT 1";
$result_quotation = mysqli_query($conn, $sql_quotation_no);
	if (mysqli_num_rows($result_quotation) > 0) {
		
?>
<h4 class="text-center alert alert-info ">Approve This sale from below List !</h4>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Price Qutation No.</th>
        <th>Company Name Or Client Name</th>
        <th>Action</th>
        <th><?php ?></th>
        
		
      </tr>
    </thead>
	<tbody>
<?php	
		
		
		$row_quotation = mysqli_fetch_array($result_quotation);
		




	
		$quotation_no=$row_quotation['quotation_no'];
		
			if(isset($quotation_no)){
				if($quotation_no >50){
					$y=$quotation_no - 20;
								for ($x = $quotation_no; $x >= $y; $x--) {
									//echo $x."</br>";
									$sql_quotation_no_serch="SELECT * FROM operations WHERE quotation_no=$x and work_oder_status='pending'";
									$result_quotation_no_serch = mysqli_query($conn, $sql_quotation_no_serch);
									if (mysqli_num_rows($result_quotation_no_serch) > 0) {
									$row_quotation_no_serch = mysqli_fetch_array($result_quotation_no_serch);
									$client_name=$row_quotation_no_serch['client_name'];
								
									}
									?>
								<!--  if price quotation >10 -->
									<tr>
										<td><?php echo $x;?></td>
										<td><?php echo $client_name;?></td>
										<td><a href="bill_info.php?price_quotation=<?php echo $x; ?>&client_name=<?php echo $client_name; ?>" >Approve this sale</a></td>
										
								   
								   
									</tr>      
					  
					
							
							
							<?php
							
						}
			?>
			</tbody>
	  </table>	
						
						
						
						
						
						
						
						
						
						
				<?php		
						
					} 
					if(($quotation_no <=50) and ($quotation_no >=0) ){
			
						for ($x = $quotation_no; $x >= 1; $x--) {
							
							
							$sql_quotation_no_serch1="SELECT * FROM operations WHERE quotation_no=$x and work_oder_status='pending'";
									$result_quotation_no_serch1 = mysqli_query($conn, $sql_quotation_no_serch1);
									if (mysqli_num_rows($result_quotation_no_serch1) > 0) {
									$row_quotation_no_serch1 = mysqli_fetch_array($result_quotation_no_serch1);
									$client_name=$row_quotation_no_serch1['client_name'];
							
							?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $client_name;?></td>
								<td><a href="bill_info.php?price_quotation=<?php echo $x; ?>&client_name=<?php echo $client_name; ?>">Approve this sale</a></td>
							</tr> 
							
							
							<?php
									}
						} 
					}
			}
			
	}
			else{
				?>
				
				
				<h4 class="text-center alert alert-warning ">There is no price quotation for Creating Bill or Print !</h4>
				
			<?php	
			}
		
	
			
			
		
		
		
		
		
		
	

?>

<?php require 'footer.php';?>