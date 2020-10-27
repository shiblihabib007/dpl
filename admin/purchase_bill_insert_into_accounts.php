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
$bill_no=$_SESSION['purchase_bill_no'];
if(isset($bill_no)){
	//echo $bill_no;
	
}
	$sql="SELECT * FROM perchases  WHERE parchase_bill_number='$bill_no' ";
	
	$result = mysqli_query($conn, $sql);

	$total_purchase_price=0;
	while($row = mysqli_fetch_array($result)){
		$supplier_name=trim($row['parchase_supplier_full_name']);
		$parchase_item_name=trim($row['parchase_item_name']);
		$parchase_item_qty=$row['parchase_item_qty'];
		$parchase_item_price=$row['parchase_item_price'];
		$parchase_item_unit =$row['parchase_item_unit'];
		$price=$parchase_item_qty * $parchase_item_price;
		
	$total_purchase_price=$total_purchase_price + $price;
	//echo $total_purchase_price."</br>";
	
	//echo $bill_no;
	//echo $supplier_name;
	//echo $parchase_item_name;
	//echo $parchase_item_qty;
	//echo $parchase_item_price;
	$db_selected_item_ammount=0;
	echo $parchase_item_name;
	$sql_purchase_item="SELECT * FROM stocks  WHERE stock_item_full_name='$parchase_item_name' ";
	$result_purchase_item = mysqli_query($conn, $sql_purchase_item);
	if (mysqli_num_rows($result_purchase_item) > 0) {
	$row_purchase_item_data = mysqli_fetch_array($result_purchase_item);
	$db_selected_item_ammount=$row_purchase_item_data['stock_item_amount'];
	$db_selected_item_ammount=$db_selected_item_ammount + $parchase_item_qty;
	echo "ase";
	$sql_stocks = "UPDATE stocks SET stock_supplier_company='$supplier_name', stock_item_full_name='$parchase_item_name', stock_item_amount='$db_selected_item_ammount',stock_item_unit='$parchase_item_unit',stock_incoming_outgoing='incoming' WHERE stock_item_full_name='$parchase_item_name'";	
	$conn->query($sql_stocks);
	}else{
		echo "nai";
	$sql_insert_first_time = "INSERT INTO stocks (stock_supplier_company, stock_item_full_name, stock_item_amount,stock_item_unit, stock_incoming_outgoing)
		VALUES ('$supplier_name','$parchase_item_name','$parchase_item_qty','$parchase_item_unit','incoming')";
	$conn->query($sql_insert_first_time);
	}
}
	$total_purchase_price=$total_purchase_price + $row['parchase_item_price'];
	$sql = "INSERT INTO accounts (acc_perchase_bill_no, acc_supplier_full_name, acc_perchase_debit,acc_perchase_due)
		VALUES ('$bill_no','$supplier_name','0','$total_purchase_price')";

	
	
									

	if ($conn->query($sql) === TRUE) {
											
		
			
			
		$_SESSION["Success_msg"]="Purchase Approved !";
		//header('refresh:3; url=price_quotation_insert.php');
		
		
		header('Location:home.php');
		//header('Location:bill_insert_into_accounts.php');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}



?>

</div>


<?php require 'footer.php';?>