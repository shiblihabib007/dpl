<?php
ob_start();
session_start();
require('fpdf/fpdf.php');




require 'auth.php';
class PDF extends FPDF
{

// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
}




$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->addPage('P');
				

	if(isset($_GET)){
		
	$price_quotation_no=$_GET['price_quotation'];
	$client_name_get=$_GET['client_name'];
	}
	
	
	$sql = "SELECT * FROM company";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	$company_full_name=ucwords($row['company_full_name']);
	$company_title=$row['company_title'];
	$address_line_1 =$row['address_line_1'];
	$address_line_2 =$row['address_line_2'];
	$address_line_3 =$row['address_line_3'];
	//echo $company_full_name;
			
			
			
			
				
			
				
				
	// Logo  padding-left, padding-up, width, height
	$pdf->image('images/logo.png',20,16,15,15);
	// Arial bold 15
	$pdf->SetFont('Arial','B',21);
	//$pdf->SetFontSize(18, 300);
	// Move to the right
	$pdf->Cell(50);
	// Title
	//box, 
	$pdf->SetFont('Arial','B',25);
	$pdf->Cell(100,27,"$company_full_name",0,0,'C');
	
	 $pdf->Ln(19);
	//$pdf->Cell(100,10,'A l l     K i n d s     o f     C a r t o n     M a n u f a c t u r e r ',0,0,'R');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(50);
	$pdf->Cell(100,4,"D-618, Painadi Natun Mahalla, Siddirgonj, Narayangonj",0,0,'C');
	$pdf->Ln();
	$pdf->Cell(50);
	$pdf->Cell(100,4,"Mobile : 01916-791810, 01707-791810",0,0,'C');
	$pdf->Ln();
	$pdf->Cell(50);
	$pdf->Cell(100,4,"Email : divinepackagingind@gmail.com",0,0,'C');
	
	$pdf->Ln(10);
	$pdf->SetLeftMargin(20);
	$pdf->SetFont('Arial','',10);
	// Move to the right
	$bill_no="Bill No :  ".$price_quotation_no;
	$pdf->Cell(30,10,"$bill_no",0,0,'L');

	
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(48);
	$pdf->Cell(20,6,"BILL",1,0,'C');
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(130,8,"Name: ......................................................................................................................................................  ",0,0,'L');
	$date="Date : ".date('d-m-Y')."......................";
	$pdf->Cell(40,8,"$date",0,0,'L');
	
	$pdf->Ln(10);
	
	$pdf->Cell(100,8,"Address: ...............................................................................................................    ",0,0,'L');
	$pdf->Cell(40,8,"  Challan No: .................................................................",0,0,'L');
	$pdf->Ln(10);
	
	$pdf->Cell(100,8,".................................................................................................................................",0,0,'L');
	$pdf->Cell(40,8,"     Order No: ..............................................................",0,0,'L');
	//$pdf->Cell(.5,10,"\n",0,5);
	
	
	//fetch data of client
	$sql2 = "SELECT * FROM clients WHERE client_company='$client_name_get'";
	$result2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_array($result2);
		
	$client_company=$row2['client_company'];
	$client_full_name=$row2['client_full_name'];
	$client_possition=$row2['client_possition'];
	$client_depertment=$row2['client_depertment'];
	$client_phone_no=$row2['client_phone_no'];
	$client_email=$row2['client_email'];
	$client_address_line_1=$row2['client_address_line_1'];
	$client_address_line_2=$row2['client_address_line_2'];
	$client_address_line_3=$row2['client_address_line_3'];
	$date=date('d-m-Y');
		
	
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(10,9,"SL#",1,0,"C");
	$pdf->Cell(120,9,"Code Or Description ",1,0,"C");
	$pdf->Cell(11,9,"Qty",1,0,"C");
	$pdf->Cell(11,9,"Rate",1,0,"C");
	$pdf->Cell(16,9,"Unit Price",1,0,"C");
	
	$pdf->Ln();
	
			
			
	$sql_quotation_no_serch="SELECT * FROM operations WHERE quotation_no='$price_quotation_no'";
	$result_quotation_no_serch = mysqli_query($conn, $sql_quotation_no_serch);
	if (mysqli_num_rows($result_quotation_no_serch) > 0) {
		$total_rows=mysqli_num_rows($result_quotation_no_serch);
		$x=1;
		$total_price=0;
		while($row_quotation_no_serch = mysqli_fetch_array($result_quotation_no_serch)) {
		
			$item_full_name=$row_quotation_no_serch['item_full_name'];
			$item_qty=$row_quotation_no_serch['item_qty'];
			$item_price=$row_quotation_no_serch['item_price'];
			
			
			$amount=$item_qty * $item_price;
			$total_price=$total_price + $amount;
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(10,4,"$x",1,0,"C");
			$pdf->Cell(120,4,"$item_full_name",1,0,"L");
			$pdf->Cell(11,4,"$item_qty",1,0,"C");
			$pdf->Cell(11,4,"$item_price",1,0,"C");
			$pdf->Cell(16,4,"$amount",1,0,"C");
			$pdf->Ln();
			
			$x=$x+1;
			
		}
		
		
	}
	$pdf->Cell(100);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30,4,"Total: ",1,0,"C");
	$pdf->Cell(11,4," ",1,0,"C");
	$pdf->Cell(11,4," ",1,0,"C");
	$pdf->Cell(16,4,"$total_price",1,0,"C");
	
	
	
	
			


	$pdf->Ln();	
	$pdf->image('images/sign.png',35,255,19,6);
	
	$pdf->Ln();
	$pdf->SetLeftMargin(30);
	$pdf->SetFont('Arial','',9);
	 $pdf->SetY(-35);
	 $pdf->Cell(130,0,"__________________",0,0,'L');
	 $pdf->Ln(4);
	$pdf->Cell(130,0,"Md. Nurul Huda",0,0,'L');
	$pdf->Ln(4);
	$pdf->Cell(130,0,"Proprietor",0,0,'L');
	$pdf->Ln(4);
	$pdf->Cell(130,0,"$company_full_name",0,0,'L');
	$pdf->Ln();	
	
	$pdf->SetLeftMargin(0);	
	
//new page add................................

$pdf->AliasNbPages();
$pdf->addPage('P');

	
			
			
	$pdf->SetLeftMargin(0);	
			
				
			
				
				
	// Logo  padding-left, padding-up, width, height
	$pdf->image('images/logo.png',20,16,15,15);
	// Arial bold 15
	$pdf->SetFont('Arial','B',21);
	//$pdf->SetFontSize(18, 300);
	// Move to the right
	$pdf->Cell(60);
	// Title
	//box, 
	$pdf->SetFont('Arial','B',25);
	$pdf->Cell(100,27,"$company_full_name",0,0,'C');
	
	 $pdf->Ln(20);
	//$pdf->Cell(100,10,'A l l     K i n d s     o f     C a r t o n     M a n u f a c t u r e r ',0,0,'R');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60);
	$pdf->Cell(100,4,"D-618, Painadi Natun Mahalla, Siddirgonj, Narayangonj",0,0,'C');
	$pdf->Ln();
	$pdf->Cell(60);
	$pdf->Cell(100,4,"Mobile : 01916-791810, 01707-791810",0,0,'C');
	$pdf->Ln();
	$pdf->Cell(60);
	$pdf->Cell(100,4,"Email : divinepackagingind@gmail.com",0,0,'C');
	
	$pdf->Ln(10);
	$pdf->SetLeftMargin(20);
	$pdf->SetFont('Arial','',10);
	// Move to the right
	$bill_no="Challan No :  ".$price_quotation_no;
	$pdf->Cell(30,10,"$bill_no",0,0,'L');

	
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(35);
	$pdf->Cell(50,6,"Delevery Challan",1,0,'C');
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(130,8,"Name: ......................................................................................................................................................  ",0,0,'L');
	$date="Date : ".date('d-m-Y')."......................";
	$pdf->Cell(40,8,"$date",0,0,'L');
	
	$pdf->Ln(10);
	
	$pdf->Cell(100,8,"Address: ...............................................................................................................    ",0,0,'L');
	$pdf->Cell(40,8,"  Job No : .................................................................",0,0,'L');
	$pdf->Ln(10);
	
	$pdf->Cell(100,8,".................................................................................................................................",0,0,'L');
	$pdf->Cell(40,8,"     Qutation No: ..............................................................",0,0,'L');
	//$pdf->Cell(.5,10,"\n",0,5);
	
	
	//fetch data of client
	$sql2 = "SELECT * FROM clients WHERE client_company='$client_name_get'";
	$result2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_array($result2);
		
	$client_company=$row2['client_company'];
	$client_full_name=$row2['client_full_name'];
	$client_possition=$row2['client_possition'];
	$client_depertment=$row2['client_depertment'];
	$client_phone_no=$row2['client_phone_no'];
	$client_email=$row2['client_email'];
	$client_address_line_1=$row2['client_address_line_1'];
	$client_address_line_2=$row2['client_address_line_2'];
	$client_address_line_3=$row2['client_address_line_3'];
	$date=date('d-m-Y');
		
	
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(10,9,"SL#",1,0,"C");
	$pdf->Cell(120,9,"Code Or Description ",1,0,"C");
	$pdf->Cell(11,9,"Qty",1,0,"C");
	$pdf->Cell(11,9,"Rate",1,0,"C");
	$pdf->Cell(16,9,"Unit Price",1,0,"C");
	
	$pdf->Ln();
	
			
			
	$sql_quotation_no_serch="SELECT * FROM operations WHERE quotation_no='$price_quotation_no'";
	$result_quotation_no_serch = mysqli_query($conn, $sql_quotation_no_serch);
	if (mysqli_num_rows($result_quotation_no_serch) > 0) {
		$total_rows=mysqli_num_rows($result_quotation_no_serch);
		$x=1;
		$total_qty=0;
		while($row_quotation_no_serch = mysqli_fetch_array($result_quotation_no_serch)) {
		
			$item_full_name=$row_quotation_no_serch['item_full_name'];
			$item_qty=$row_quotation_no_serch['item_qty'];
			$item_price=$row_quotation_no_serch['item_price'];
			
			
			//$amount=$item_qty * $item_price;
			$total_qty=$total_qty + $item_qty;
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(10,4,"$x",1,0,"C");
			$pdf->Cell(120,4,"$item_full_name",1,0,"L");
			$pdf->Cell(11,4,"$item_qty",1,0,"C");
			$pdf->Cell(11,4,"$item_price",1,0,"C");
			$pdf->Cell(16,4,"",1,0,"C");
			$pdf->Ln();
			
			$x=$x+1;
			
		}
		
		
	}
	$pdf->Cell(100);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(30,4,"Total: ",1,0,"C");
	$pdf->Cell(11,4," $total_qty",1,0,"C");
	$pdf->Cell(11,4," ",1,0,"C");
	$pdf->Cell(16,4,"",1,0,"C");
	
	
			


	$pdf->Ln();	
	$pdf->image('images/sign.png',35,255,19,6);
	
	$pdf->Ln();
	$pdf->SetLeftMargin(30);
	$pdf->SetFont('Arial','',9);
	 $pdf->SetY(-35);
	 $pdf->Cell(130,0,"__________________",0,0,'L');
	 $pdf->Ln(4);
	$pdf->Cell(130,0,"Md. Nurul Huda",0,0,'L');
	$pdf->Ln(4);
	$pdf->Cell(130,0,"Proprietor",0,0,'L');
	$pdf->Ln(4);
	$pdf->Cell(130,0,"$company_full_name",0,0,'L');
	$pdf->Ln();	


$pdf->Output();
?>