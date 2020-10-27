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
<div class="container  ">
<h4 class="text-center alert alert-info ">Select Bill For Cash Recieve!</h4>
<?php 
if(isset($_SESSION["error_msg"])){
?>	
	<h4 class="text-center heading-color alert alert-warning">
	<?php echo $_SESSION["error_msg"]; ?>
	
	</h4>;
	<?php
	$_SESSION["error_msg"]=null;
	
}
if(isset($_SESSION["success_msg"])){
?>	
	<h4 class="text-center alert alert-success">
	<?php echo $_SESSION["success_msg"]; ?>
	
	</h4>;
	<?php
	
	$_SESSION["success_msg"]=null;
	
}

?>


<?php

	

	
	
	
$sql="SELECT * FROM bills";
				$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
		
			
		?>
	<form action="perchase_confirm.php" method="post">
	<div class="form-group col-md-6 col-md-offset-3">	
	<table class="table">
    <thead>
      <tr>
       
		<th>Unit</th>
        <th>Item Price</th>
		
      </tr>
    </thead>
	<?php
   
		while($row = mysqli_fetch_array($result)) {
			?>
	
    <tbody>
      <tr>
	   <td><?php echo $row['id'];?></td>
        <td><input type="checkbox" name="check_list[]" value="<?php echo $row['id'];?>"> <td>
        <td><?php echo trim($row['bills_name']); ?></td>
		
        <td><input type="number" name="item_price[<?php echo $row['id'];?>]" class="form-control" value="" ></td>
      </tr>      
      
    
			
			
			<?php
			
		}
		?>
		</tbody>
  </table>
  <button class="btn btn-default btn-primary" name="submit"> Submit</button>
  </div>
</form>
  <?php
	}
	
			
			?>
			
</div>

<?php require 'footer.php';?>