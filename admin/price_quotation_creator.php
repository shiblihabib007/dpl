<?php
require('fpdf/fpdf.php');



	

class PDF extends FPDF
{
	
// Page header
function Header()
{
require 'auth.php';
ob_start();
session_start();
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
    $this->image('images/logo.png',20,20,12,12);
    // Arial bold 15
    $this->SetFont('Arial','B',21);
	//$this->SetFontSize(18, 300);
    // Move to the right
    $this->Cell(60);
    // Title
	//box, 
    $this->Cell(28,27,"$company_full_name",0,0,'C');
	$this->SetFont('Arial','',11);
	$this->Cell(37,40,'A l l     K i n d s     o f     C a r t o n     M a n u f a c t u r e r ',0,0,'R');
	
	
	
	
	$this->SetFont('Arial','',6.5);
    // Move to the right
    $this->Cell(25);
	$this->Cell(10,24,"$address_line_1",0,0,'C');
	$this->SetFont('Arial','B',9);
	$this->Cell(20,32,"$address_line_2",0,0,'R');
	$this->SetFont('Arial','',8);
	$this->Cell(.5,40,"$address_line_3",0,0,'R');
	$this->Cell(.5,10,"\n",0,5);
	
	if(isset($_GET)){
		
		$price_quotation_no=$_GET['price_quotation'];
		$client_name_get=$_GET['client_name'];
	}
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
		
		
    // Line break
    $this->Ln(20);
	// set left margin
	$this->SetLeftMargin(20);
	$this->SetFont('Arial','',9);
	$this->Cell(100,10,"$date",0,0,'L');
	$this->Ln(4);
	$this->Cell(40,10,'TO',0,0,'L');
	$this->Ln(4);
	$this->Cell(40,10,"$client_full_name",0,0,'L');
	$this->Ln(4);
	$this->Cell(40,10,"$client_possition",0,0,'L');
	$this->Ln(4);
	$this->Cell(40,10,"$client_depertment",0,0,'L');
	$this->Ln(4);
	$this->Cell(40,10,"$client_company",0,0,'L');
	$this->Ln(4);
	$this->Cell(40,10,"$client_address_line_1",0,0,'L');
	$this->Ln(4);
	$this->Cell(40,10,"$client_address_line_2",0,0,'L');
	$this->Ln(4);
	$this->Cell(40,10,"$client_address_line_3",0,0,'L');
	
	
	$this->Ln(10);
	$this->Cell(60);
	$this->SetFont('Arial','U',12);
	$this->Cell(40,10,'Quotation',0,0,'R');
	
	
	
	
	
	$this->Ln(10);
	$this->SetFont('Arial','B',9);
	$this->Cell(10,9,"SL#",1,0,"C");
	$this->Cell(120,9,"Code Or Description ",1,0,"C");
	$this->Cell(11,9,"Unit",1,0,"C");
	$this->Cell(11,9,"Qty",1,0,"C");
	$this->Cell(16,9,"Unit Price",1,0,"C");
	
	$this->Ln();
	
	
	
	$sql_quotation_no_serch="SELECT * FROM operations WHERE quotation_no='$price_quotation_no'";
	$result_quotation_no_serch = mysqli_query($conn, $sql_quotation_no_serch);
	if (mysqli_num_rows($result_quotation_no_serch) > 0) {
		$total_rows=mysqli_num_rows($result_quotation_no_serch);
		$x=1;
		while($row_quotation_no_serch = mysqli_fetch_array($result_quotation_no_serch)) {
		
			$item_full_name=$row_quotation_no_serch['item_full_name'];
			$item_qty=$row_quotation_no_serch['item_qty'];
			$item_price=$row_quotation_no_serch['item_price'];
			
			 
			
			$this->SetFont('Arial','',8);
			$this->Cell(10,4,"$x",1,0,"C");
			$this->Cell(120,4,"$item_full_name",1,0,"L");
			$this->Cell(11,4,"Pieces",1,0,"C");
			$this->Cell(11,4,"$item_qty",1,0,"C");
			$this->Cell(16,4,"$item_price",1,0,"C");
			$this->Ln();

			$x=$x+1;
			
		}
		
	}	
	
	
	
	
	
			


	$this->Ln();	
	$this->image('images/sign.png',35,255,19,6);
	
	$this->Ln();
	$this->SetLeftMargin(30);
	$this->SetFont('Arial','',9);
	 $this->SetY(-35);
	 $this->Cell(130,0,"__________________",0,0,'L');
	 $this->Ln(4);
	$this->Cell(130,0,"Md. Nurul Huda",0,0,'L');
	$this->Ln(4);
	$this->Cell(130,0,"Proprietor",0,0,'L');
	$this->Ln(4);
	$this->Cell(130,0,"$company_full_name",0,0,'L');
}

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

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();

//$pdf->AddPage();
//$pdf->SetFont('Times','',12);
//for($i=1;$i<=40;$i++)
    //$pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>