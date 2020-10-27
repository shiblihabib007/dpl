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
<h4 class="text-center alert alert-info">All Items Info!</h4>
<?php	
$sql_items="SELECT * FROM items ORDER BY item_creating_date ASC";
$result_items = mysqli_query($conn, $sql_items);
	if (mysqli_num_rows($result_items) > 0) {
		?>
		<table class="table table-bordered">
    <thead>
      <tr>
        <th>SL</th>
        <th>Item Full Name</th>
        <th>Item Size</th>
        <th>Item Price</th>
        <th>Adding Date</th>
        
		
      </tr>
    </thead>
	<tbody>
		
		
		<?php
		$x=1;
		while($row_items = mysqli_fetch_array($result_items)){
				$id=$row_items['id'];
				$item_catagory_name=$row_items['item_catagory_name'];			
				$item_model_name=$row_items['item_model_name'];	
				
				$item_size=$row_items['item_size'];			
				$item_price=$row_items['item_price'];			
						
				$item_creating_date=$row_items['item_creating_date'];	
				$timeStamp = date( "m/d/Y", strtotime($item_creating_date));						
							
				$full_name=	$item_catagory_name.", ".$item_model_name;
						
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $full_name;?></td>
					<td><?php echo $item_size;?></td>
					<td><?php echo $item_price;?></td>
					
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
		<h4 class="text-center alert alert-warning ">There is no Sale Item!</h4>
		
		
		
	<?php	
	}

	
			
			
		?>
		
		</tbody>
	  </table>	
		
		
		
	



<?php require 'footer.php';?>