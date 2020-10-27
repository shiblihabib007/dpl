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
<?php 
 /*$sql1 = "TRUNCATE TABLE items";
mysqli_query($conn,$sql1);*/
?>


<div class="body_part">
<?php
// $sql1 = "TRUNCATE TABLE sis_stock";
    // mysqli_query($conn,$sql1);
	if(isset($_POST['submit']))
    {
	$target_dir = "";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists
if (file_exists($target_file)) {
    $mass7= "Sorry, file already exists.";
	
    $uploadOk = 0;
	unlink('' . $target_file);
}
// Check file size

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $mass6= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $mass1= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
		
        $mass5= "Sorry, there was an error uploading your file.";
    }
}

	
	
	
	

		
         $fname = $_FILES['fileToUpload']['name'];
		 if(!empty( $fname)){
         
	
		 
         $chk_ext = explode(".",$fname);
        
         if(strtolower(end($chk_ext)) == "txt")
         {
            	$sql2 = "LOAD DATA LOCAL INFILE '$target_file' INTO TABLE `items` FIELDS TERMINATED BY '|' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' ( `item_catagory_name` , `item_model_name`, `item_size`,`item_price`,`item_full_name`)";
$loaddata = mysqli_query($conn,$sql2);
if (!$loaddata) {
	die('Could not load data from file into table: ' .mysqli_error($conn));
}
           
            $success= "Successfully Imported ( ".$fname." )";
			$_SESSION["success"]="$success";
			
         }
         else
         {
            $mass2= "Invalid File";
         } 
		 }
		 else{
		 $mass= "Please Select A File";
		 }  
    }
	
?>
<div class="import_file_to_add_acc">
    <form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">
	<p><span style="font-size:20px; font-weight:bold; <?php if(isset($mass2) or isset($mass) or isset($not_found) or isset($mass7) or isset($mass6) or isset($mass5)){echo "color:#FF0000";} elseif(isset($success) ){echo"color:#3333FF";}else{echo"color:#009966";}?>;"><?php if(isset($mass7)){echo $mass7."</br>";} if(isset($mass6)){echo $mass6."</br>";} if(isset($mass5)){echo $mass5."</br>";} if(isset($mass1)){echo $mass1."</br>";} if(isset($mass)){echo $mass;} if(isset($success)and isset($mass1)){echo $success."</br>";}if(isset($mass2)){echo $mass2;}if(isset($not_found)){ echo $not_found;}?></span></p>
       <span style="color:#009966; font-size:24px; font-weight:bold">Client Registration</span> <input type='file' name='fileToUpload' size='200' id="fileToUpload"></br>
        <input style="width:150px; height:30px; color:#993366; border-radius:3px; font-size:20px; background:#00CCCC;"type='submit' name='submit' value='Upload'>
    </form>
</div>
</div>

<?php require 'footer.php';?>
