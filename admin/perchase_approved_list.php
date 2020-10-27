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
$sql_purchase_bill_no="SELECT * FROM perchases WHERE parchase_approve_status='approved' ORDER BY id DESC LIMIT 1";
$result_perchase_bill = mysqli_query($conn, $sql_purchase_bill_no);
	if (mysqli_num_rows($result_perchase_bill) > 0) {
		
?>
<h4 class="text-center alert alert-info ">Approved Purchase from below List !</h4>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Purchase Internal Bill No.</th>
        <th>Supplier Name</th>
        <th>Action</th>
       
        
		
      </tr>
    </thead>
	<tbody>
<?php	
		
		
		$row_purchase_bill = mysqli_fetch_array($result_perchase_bill);
		




	
		$bill_no=$row_purchase_bill['parchase_bill_number'];
		
			if(isset($bill_no)){
				if($bill_no >50){
					$y=$bill_no - 20;
								for ($x = $bill_no; $x >= $y; $x--) {
									//echo $x."</br>";
									$sql_bill_no_serch="SELECT * FROM perchases WHERE parchase_bill_number=$x and parchase_approve_status='approved'";
									$result_bill_no_serch = mysqli_query($conn, $sql_bill_no_serch);
									if (mysqli_num_rows($result_bill_no_serch) > 0) {
									$row_bill_no_serch = mysqli_fetch_array($result_bill_no_serch);
									$supplier_name=$row_bill_no_serch['parchase_supplier_full_name'];
								
									}
									?>
								<!--  if price quotation >10 -->
									<tr>
										<td><?php echo $x;?></td>
										<td><?php echo $supplier_name;?></td>
										<td><a href="approved_purchase_info.php?purchase_bill_no=<?php echo $x; ?>&supplier_name=<?php echo $supplier_name; ?>" >View</a></td>
										
								   
								   
									</tr>      
					  
					
							
							
							<?php
							
						}
			?>
			</tbody>
	  </table>	
						
						
						
						
						
						
						
						
						
						
				<?php		
						
					} 
					if(($bill_no <=50) and ($bill_no >=0) ){
			
						for ($x = $bill_no; $x >= 1; $x--) {
							
							
							$sql_bill_no_serch="SELECT * FROM perchases WHERE parchase_bill_number=$x and parchase_approve_status='approved'";
									$result_bill_no_serch = mysqli_query($conn, $sql_bill_no_serch);
									if (mysqli_num_rows($result_bill_no_serch) > 0) {
									$row_bill_no_serch = mysqli_fetch_array($result_bill_no_serch);
									$supplier_name=$row_bill_no_serch['parchase_supplier_full_name'];
							
							?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $supplier_name;?></td>
								<td><a href="approved_purchase_info.php?purchase_bill_no=<?php echo $x; ?>&supplier_name=<?php echo $supplier_name; ?>" >View</a></td>
								
								   
								   
							</tr> 
							
							
							<?php
									}
						} 
					}
			}
			
	}
			else{
				?>
				
				
				<h4 class="text-center alert alert-warning ">There is no Purchase  to approve !</h4>
				
			<?php	
			}
		
	
			
			
		
		
		
		
		
		
	

?>

<?php require 'footer.php';?>