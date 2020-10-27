<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
	
// Page header
function Header()
{
	
    // Logo  padding-left, padding-up, width, height
    $this->Image('asset/logo.jpg',20,20,12,12);
    // Arial bold 15
    $this->SetFont('Arial','B',21);
	//$this->SetFontSize(18, 300);
    // Move to the right
    $this->Cell(60);
    // Title
	//box, 
    $this->Cell(28,27,'Devine Packaging Industries',0,0,'C');
	$this->SetFont('Arial','',11);
	$this->Cell(37,40,'A l l     K i n d s     o f     C a r t o n     M a n u f a c t u r e r ',0,0,'R');
	
	
	
	
	$this->SetFont('Arial','',6.5);
    // Move to the right
    $this->Cell(25);
	$this->Cell(10,24,'26/08/A, North Perarbagh, Mirpur, Dhaka-1216',0,0,'C');
	$this->SetFont('Arial','B',9);
	$this->Cell(20,32,'Phone : 8090179, Fax : 8090180 ',0,0,'R');
	$this->SetFont('Arial','',8);
	$this->Cell(.5,40,'Mobile : 01916-791810, 01616-791810',0,0,'R');

    // Line break
    //$this->Ln(20);
	
	
	
	
	
	
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



<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	
</body>
</html>