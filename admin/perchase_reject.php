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
$sql_bill_no="SELECT * FROM perchases WHERE parchase_approve_status='pending' ORDER BY id DESC";
$result_bill = mysqli_query($conn, $sql_bill_no);
	if (mysqli_num_rows($result_bill) > 0) {
		?>
		<table class="table table-bordered">
    <thead>
      <tr>
        <th>Bill No.</th>
        <th>Supplier Name</th>
        <th>Action</th>
        
		
      </tr>
    </thead>
	<tbody>
		
		
		<?php
		
		$row_perchase = mysqli_fetch_array($result_bill);
		$parchase_bill_number=$row_perchase['parchase_bill_number'];
		
			if(isset($parchase_bill_number)){
				
					for ($x = $parchase_bill_number; $x >= 1; $x--) {
							
							
							$sql_bill_no_serch1="SELECT * FROM perchases WHERE parchase_approve_status='pending' and parchase_bill_number='$x'";
									$result_bill_no_serch1 = mysqli_query($conn, $sql_bill_no_serch1);
									if (mysqli_num_rows($result_bill_no_serch1) > 0) {
									$row_perchase_no_serch1 = mysqli_fetch_array($result_bill_no_serch1);
									$parchase_supplier_full_name=$row_perchase_no_serch1['parchase_supplier_full_name'];
									$parchase_date=$row_perchase_no_serch1['parchase_date'];
									
									//$currenttime = date($delivery_date);
									//$tmstp = $delivery_date + strtotime('+ 24 hours');
									//$newtime = date("Y-m-d h:m:s.f", $tmstp);
									//$date=date_create("2013-03-15");
										//$delivery_date=date_format($delivery_date, 'Y-m-d');			
							?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $parchase_supplier_full_name;?></td>
								<td><a href="perchase_reject_info.php?bill_no=<?php echo $x; ?>& supplier_full_name=<?php echo $parchase_supplier_full_name; ?>">Reject</a></td>
							</tr> 
							
							
							<?php
									}
						} 
			?>
			
						
						
						
						
						
						
						
						
						
						
				<?php		
						
					
					
			}
			
	}
			else{
				?>
				<h4 class="text-center alert alert-warning ">There is no Purchase  to Edit !</h4>
				
				
				
			<?php	
			}
		
	
			
			
		?>
		
		</tbody>
	  </table>	
		
		
		
	



<?php require 'footer.php';?>