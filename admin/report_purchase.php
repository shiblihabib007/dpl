<?php
ob_start();
session_start();
if(isset($_SESSION["user"])){
	
	if($_SESSION["user"]=="employee"){
		
		header('Location:../employee/home.php');
		
	}
}
require 'header.php';
require 'nav.php';
?>

<div class="container">
<?php
if(isset($_POST['submit'])){
	
	$start_date=$_POST['start_date']." 00:00:00";
	$end_date=$_POST['end_date']." 23:59:59";

		
			
	
$sql="SELECT * FROM perchases WHERE parchase_approve_status='approved' and  parchase_date BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		
	?>
<h4 class="text-center alert alert-success ">Purchase list during this period !</h4>
<div class="col-md-10 col-md-offset-1">
	<table class="table table-condensed table-responsive table-bordered ">
    <thead>
      <tr>
        <th>SL</th>
        <th>Bill No. </th>
		<th>Item Name</th>
        <th>Total QTY</th>
		<th>Price</th>
		<th>Total</th>
		
		<th>Date</th>
		
		
		
        
		
        
		
      </tr>
    </thead>
	 <tbody>
<?php	
		$db_bill_number=array();
		while($row1 = mysqli_fetch_array($result)) {
			$db_bill_number[]=$row1['parchase_bill_number']; 
		}
		$db_unique_bill_number1=array_unique($db_bill_number);
		$db_unique_bill_number=array_count_values($db_unique_bill_number1);
		$db_unique_bill_number=sizeof($db_unique_bill_number);
		//echo( $db_unique_bill_number); 
		if($db_unique_bill_number >0){
			$x=1;
			foreach($db_unique_bill_number1 as $gotten_bill_number){
				//echo $gotten_bill_number;
				$sql1="SELECT * FROM perchases WHERE parchase_approve_status='approved' and parchase_bill_number='$gotten_bill_number'";
				$result1 = mysqli_query($conn, $sql1);
				$grand_total=0;
				while($row = mysqli_fetch_array($result1)) {
			$parchase_bill_number=$row['parchase_bill_number']; 
			
			$parchase_item_name=$row['parchase_item_name']; 
			$parchase_item_qty=$row['parchase_item_qty']; 
			$parchase_item_unit=$row['parchase_item_unit']; 
			$parchase_item_price=$row['parchase_item_price']; 
			
			$parchase_item_total_price=$parchase_item_qty * $parchase_item_price;
			$grand_total=$grand_total + $parchase_item_total_price;
			$acc_transection_date=$row['parchase_date'];

			$timeStamp = date( "m/d/Y", strtotime($acc_transection_date));
			
			

			?>
		 <tr>
	   <td><?php echo $x ;?></td>
	   <td><?php echo $parchase_bill_number ;?></td>
	   <td><?php echo $parchase_item_name ;?></td>
	   <td><?php echo $parchase_item_qty." ".$parchase_item_unit ;?></td>
	   
	   <td><?php echo $parchase_item_price." /=" ;?></td>
	   <td><?php echo $parchase_item_total_price." /=" ;?></td>
	   

	   
	   
	   <td><?php echo $timeStamp ;?></td>
	   
		
		
        
      </tr>  
	  <?php
			
			
		$x =$x +1;	 
		}
		?>
		<tr>
		

	   
	
	   <td  colspan="5" class="centered text-center"><?php 
			if(isset($gotten_bill_number)){
			?>
			<img style="width:600px; height:250px " class="img-fluid" src="voucher/<?php echo $gotten_bill_number; ?>.jpg" alt="voucher" />
			<?php
			
			}
	   
	   
	   ?>
	   </td>
	   <td style="line-height: 1800%;"><?php echo "Sub Total= ".$grand_total." /=";?></td>
	  
		
		
        
      </tr> 
	<?php	  
		
		
				
			}
			
		
		}
		
		
	
		
		
		
		
	}
	else{
		?>
		
		<h4 class="text-center alert alert-warning ">There is no purchase between this time duration !</h4>
	<?php
	}

}
?>
<h4 class="text-center alert alert-info ">Select Date to show purchases during a time period !</h4>
<form action="report_purchase.php" method="post">
	<div class="form-group col-md-2 col-md-offset-3">
		<label for="from_date" >Start Date </label>
		<input type="date" id="from_date" name="start_date" class="form-control" value="" required >
		
	</div>
	<div class="form-group col-md-2">
		<label for="to_date" >End Date </label>
		<input type="date" id="to_date" name="end_date" class="form-control" value="" required >
			
	</div>
	<div class="form-group col-md-2">
		<label for="to_date" ></label>
		<button class="btn btn-default btn-primary form-control" name="submit"> Submit</button>
			
	</div>

	
 
 
 
 </form>
  
  
  
  
</div>


<?php require 'footer.php';?>