<?php
ob_start();

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

if(isset($_POST['submit'])){
	
	if(!empty($_POST['check_list'])) {
		
	$voucher_no=trim($_POST['bill_no']);
		
		//image upload start-----------------------------------------------------
	$target_dir = "voucher/";
	$old_file_name=basename($_FILES["fileToUpload"]["name"]);
	$userfile_extn = explode(".", strtolower($_FILES["fileToUpload"]["name"]));
	
	$new_file_name=$voucher_no.".".$userfile_extn[1];
	
	 //rename($old_file_name, $new_file_name);
	
	//$final_name=rename( "../".$old_file_name, $new_file_name) ; 
	$target_file = $target_dir . $new_file_name;


$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);



if($imageFileType!=='png' and $imageFileType=='jpg' and $imageFileType!=='jpeg'){
	
	

// Check if image file is a actual image or fake image
if (file_exists($target_file)==true) {
  
	$_SESSION["error_msg"]="Sorry, file already exists.";
    $uploadOk = 0;
	header('Location:all_perchase_items.php');
	
	//unlink('' . $target_file);
}

//rename("$target_file","pictures");
// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    
	$_SESSION["error_msg"]="Sorry, This cheque is already exists.";
// if everything is ok, try to upload file
} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		$_SESSION["cheque_upload_success"]="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
    
	
//image upload end-----------------------------------------------------


		
		
		
		
		
		
		
		
		
		
			$sl=1;
			$qty=0;
			
			foreach($_POST['check_list'] as $id) {	
					$sql = "SELECT * FROM perchase_items WHERE id='$id'";
					$result = mysqli_query($conn, $sql);
					$data_item_id=array();
					$data_item_name=array();
					$data_item_qty=array();
					$data_item_price=array();
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_array($result)) {
								$perchase_item_unit=$row['perchase_item_unit'];
									
							
								$item_id=$id;
								$perchase_item_full_name=trim($row['perchase_item_full_name']);
								$qty =$_POST['qty']["$id"];
								$price =$_POST['item_price']["$id"];
								$bill_no=$_POST['bill_no'];
								$supplier_full_name=$_POST['supplier_full_name'];
								$total_price= $qty * $price;
								
									$sql = "INSERT INTO perchases (parchase_bill_number, parchase_supplier_full_name, parchase_item_name, parchase_item_qty, parchase_item_unit,parchase_item_price,parchase_item_total_price,parchase_approve_status )
									VALUES ('$bill_no','$supplier_full_name','$perchase_item_full_name','$qty','$perchase_item_unit', '$price','$total_price', 'pending')";
									
									

									if ($conn->query($sql) === TRUE) {
										$_SESSION["purchase_Success_msg"]="Purchase Bill Successfully Submitted !";
										//header('refresh:3; url=price_quotation_insert.php');
										header('Location:home.php');
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}

							
								}
													
													
													
													
														


					}
								
							
				}
				$sl=$sl+1;	
				$qty=$qty+1;	
				
				
			}
			
			}
			
				
	}else{
		$_SESSION["error_msg"]="Sorry, File type is not valid, please try with 'jpg'.";
		header('Location:home.php');
	}	
			
		}
		
	
		
	}
	else{
		header('Location:home.php');
	}
?>
</div>			
<?php require 'footer.php';?>