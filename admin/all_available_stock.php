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

		
		
		
if(isset($_SESSION["quantity_empty"])){
	?>
	<h4 class="text-center alert alert-warning"><?php echo $_SESSION["quantity_empty"]; ?> </h4>
	
	
	<?php
	$_SESSION["quantity_empty"]=null;
}
 ?>
 <?php
if(isset($_SESSION["Success_msg"])){
	?>
	<h4 class="text-center alert alert-success"><?php echo $_SESSION["Success_msg"]; ?> </h4>
	
	
	<?php
	$_SESSION["Success_msg"]=null;
}
 

	
	
 $sql = "SELECT * FROM stocks";
	$result = mysqli_query($conn, $sql);
	
	
	if (mysqli_num_rows($result) > 0) {
		
		
		?>
		<h4 class="text-center alert alert-info">Select  Item to Stock-Out !</h4>
		<form action="stock_out_confirm.php" method="post">
		<div class="form-group col-md-6">
		
			
			  
			  
			</select>
		</div>
	<table class="table">
    <thead>
      <tr>
        <th>SL</th>
        <th>Select</th>
        <th></th>
        <th>Items Description</th>
        
        <th>Available Quantity</th>
		<th>Stock-Out Quantity</th>
        
		
      </tr>
    </thead>
	<?php
   
		while($row = mysqli_fetch_array($result)) {
			
			?>
	
    <tbody>
      <tr>
	   <td><?php echo $row['id'];?></td>
        <td><input type="checkbox" name="check_list[]" value="<?php echo $row['id'];?>"> <td>
        <td><?php echo trim($row['stock_item_full_name']); ?></td>
        
        <td><?php echo trim($row['stock_item_amount'])." ".$row['stock_item_unit']; ?></td>
		
		<td><input type="number" name="qty[<?php echo $row['id']; ?>]" class="form-control" value="" ></td>
		
        
      </tr>      
      
    
			
			
			<?php
			
		}
		?>
		</tbody>
  </table>
  <button class="btn btn-default btn-primary" name="submit"> Submit</button>
</form>
  <?php
	}else{
				?>
				
				
				<h4 class="text-center alert alert-warning ">There is no Stock available  !</h4>
				
			<?php	
			}
	
			
			?>
			
</div>

<?php require 'footer.php';?>