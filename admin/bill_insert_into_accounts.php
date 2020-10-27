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
$bill_no=$_SESSION["bill_no"];
	$sql="SELECT * FROM operations  WHERE quotation_no='$bill_no' ";
	
	$result = mysqli_query($conn, $sql);

	$total_sale_price=0;
	while($row = mysqli_fetch_array($result)){
		$client_name=trim($row['client_name']);
		$item_qty=$row['item_qty'];
		$item_price=$row['item_price'];
		
		$vat_rate_for_this_client= $row['item_price'];
		$price=$item_qty * $item_price;
		$vat_rate=
		$total_sale_price=$total_sale_price + $price;
		//echo $total_sale_price."</br>";
	
	}
	$sql_client="SELECT * FROM clients  WHERE client_company ='$client_name' ";
	
	$result_client = mysqli_query($conn, $sql_client);
	$row_client_data = mysqli_fetch_array($result_client);
	
	$client_full_name=$row_client_data['client_full_name'];
	$client_given_vat_rate=$row_client_data['client_recievable_vat']  / 100;
	$recievable_vat_from_client=$total_sale_price * $client_given_vat_rate ;
	$recievable_vat_from_client=(ceil($recievable_vat_from_client));
	
	$total_sale_price_with_vat=  $total_sale_price + $recievable_vat_from_client ;
	
	
	
	$client_wanted_vat_rate=$row_client_data['client_payable_vat']/100;
	$payable_vat_from_our_company=$total_sale_price_with_vat * $client_wanted_vat_rate ;
	$payable_vat_from_our_company=floor($payable_vat_from_our_company);
	
	$total_sale_price_with_return_vat= $total_sale_price_with_vat - $payable_vat_from_our_company;
	
	
	$net_vat= $recievable_vat_from_client - $payable_vat_from_our_company;
	
	
	

	
$sql = "INSERT INTO accounts (acc_sale_bill_no, acc_company_full_name, acc_item_price_in_total,acc_bill_due,acc_bill_due_vat,acc_bill_due_vat_adjusted, acc_bill_reducable_by_client_vat)
		VALUES ('$bill_no','$client_name','$total_sale_price','$total_sale_price','$recievable_vat_from_client','$net_vat','$payable_vat_from_our_company')";

	

									

if ($conn->query($sql) === TRUE) {
										
	
	$_SESSION["Success_msg"]="Bill and Challan Is Successfully Created !";
	//header('refresh:3; url=price_quotation_insert.php');
	
	
	header('Location:home.php');
	//header('Location:bill_insert_into_accounts.php');
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}


?>

</div>


<?php require 'footer.php';?>