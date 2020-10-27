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

$_SESSION['id']=null;
$_SESSION['category_name']=null;
$_SESSION['amount']=null;

	
$sql="SELECT * FROM expenses WHERE expense_approve_status ='pending' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		
?>
<h4 class="text-center alert alert-info ">Approve Purchase from below List !</h4>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>SL</th>
        <th>Expense Category Name</th>
        <th>Amount</th>
        <th>Action</th>
       
        
		
      </tr>
    </thead>
	<tbody>
<?php	
		$x=1;
		while($row=mysqli_fetch_array($result)){
			$id=$row['id'];
			$category=$row['expense_catagory_name'];
			
			
			?>
			<tr>
				<td><?php echo $x ; ?></td>
				<td><?php echo $row['expense_catagory_name'] ; ?></td>
				<td><?php echo $row['expense_amount'] ; ?></td>
				<td><a href="reject_expense_info.php?id=<?php echo $id; ?>" >Reject</a></td>
				
			
			</tr>
			
			
			<?php
			
		$x=$x+1;	
		}
		
						
			?>
			</tbody>
	  </table>	
						
						
						
						
						
				<?php
				
				
				
	
	}
			else{
				?>
				
				
				<h4 class="text-center alert alert-warning ">There is no Expense  to approve !</h4>
				
			<?php	
			}
		
	
			
			
		
		
		
		
		
		
	

?>

<?php require 'footer.php';?>