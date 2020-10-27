<?php
require_once('fpdf/fpdf.php');
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitpcl";
try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $data= "Success!";
}
 catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
	 }*/
?>
<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitpcl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql_info_company = "select * from company_info";
$company_data = $conn->query($sql_info_company);
$data = $company_data->fetch_assoc();
$info_company_trec_no=$data['info_company_trec_no'];
$info_company_dp_no=$data['info_company_dp_no'];
$info_company_name=$data['info_company_name'];
$info_company_stock_exchange=$data['info_company_stock_exchange'];



$sql_ipo = "select * from ipo";
$ipo_data = $conn->query($sql_ipo);
$ipo_company_data = $ipo_data->fetch_assoc();
$ipo_full_name=$ipo_company_data['ipo_full_name'];
$ipo_market_lot=$ipo_company_data['ipo_market_lot'];
$ipo_price_per_lot_bdt=$ipo_company_data['ipo_price_per_lot_bdt'];
$ipo_price_per_lot_usd=$ipo_company_data['ipo_price_per_lot_usd'];
$ipo_price_per_lot_gbp=$ipo_company_data['ipo_price_per_lot_gbp'];
$ipo_price_per_lot_eur=$ipo_company_data['ipo_price_per_lot_eur'];
$ipo_script_cse=$ipo_company_data['ipo_script_cse'];

class PDF extends FPDF
{
function Footer()
{
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
    // Print current and total page numbers
    $this->Cell(0,4,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->addPage('L');
$pdf->SetFont('Arial','B',12);
$name=$info_company_name." "."MEMBAR "."$info_company_stock_exchange "."#"."$info_company_trec_no"."\n";
$pdf->Cell(200,4,"$name",0,1,"C");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(300,4," ",0,1,"C");
$ipo_name="\n".$ipo_full_name."\n";
$pdf->Cell(200,4,"$ipo_name",0,1,"C");
$pdf->SetFont('Arial','',8);
$pdf->Cell(200,4,"Catagory Of Applicant : NRB",0,1,"C");
$pdf->SetFont('Arial','B',8);
$sql = "select * from application WHERE client_catagory='NRB' AND app_currency='USD'";
$result = $conn->query($sql);
		 $pdf->Cell(10,4,"SL#",1,0,"C");
		 $pdf->Cell(15,4,"TREC NO",1,0,"C");
         $pdf->Cell(10,4,"DPID",1,0,"C");
         $pdf->Cell(20,4,"Customer ID",1,0,"C");
	
	
         $pdf->Cell(50,4,"Applicant's Name",1,0,"C");
		
	
         $pdf->Cell(30,4,"BOID No",1,0,"C");
		
		 $pdf->Cell(15,4,"Catagory",1,0,"C");
		 $pdf->Cell(15,4,"Currency",1,0,"C");
		 $pdf->Cell(15,4,"Amount",1,0,"C");
		 $pdf->Cell(15,4,"Draft No",1,0,"C");
		 $pdf->Cell(15,4,"Bank Name",1,0,"C");
		 $pdf->Cell(30,4,"Branch Name",1,0,"C");
		 $pdf->Cell(15,4,"Date",1,0,"C");
		 $pdf->Cell(15,4,"Remarks",1,1,"C");
if ($result->num_rows > 0) {
    // output data of each row
    $row_cnt = $result->num_rows;
		$sl=1;
		$pdf->SetFont('Arial','',8);
    while($row = $result->fetch_assoc()) {
		$pdf->Cell(10,4,"$sl",1,0,"C");
		$pdf->Cell(15,4,"$info_company_trec_no",1,0,"C");
        $pdf->Cell(10,4,"$info_company_dp_no",1,0,"C");
        $show1=$row["client_code"];
        $pdf->Cell(20,4,"$show1",1,0,"C");
	
		$show2=$row["client_name"];
        $pdf->Cell(50,4,"$show2",1,0,"C");
		
		$show3=$row["client_boid"];
        $pdf->Cell(30,4,"$show3",1,0,"C");
		$show4=$row["client_catagory"];
        $pdf->Cell(15,4,"$show4",1,0,"C");
		$ipo_market_lot1=$ipo_market_lot;
		$pdf->Cell(15,4,"USD",1,0,"C");
		$pdf->Cell(15,4,"$ipo_price_per_lot_usd",1,0,"C");
		$app_draft_no=$row["app_draft_no"];
		$pdf->Cell(15,4,"$app_draft_no",1,0,"C");
		$client_nrb_bank=$row["client_nrb_bank"];
		$pdf->Cell(15,4,"$client_nrb_bank",1,0,"C");
		$client_nrb_bank_branch=$row["client_nrb_bank_branch"];
		$pdf->Cell(30,4,"$client_nrb_bank_branch",1,0,"C");
		$app_date=$row["app_date"];
		
		$pdf->Cell(15,4,"$app_date",1,0,"C");
		
		$pdf->Cell(15,4,"$ipo_script_cse",1,1,"C");
		$sl=$sl + 1;
    } 
	$pdf->Cell(5,4,"",0,0,"C");
	$pdf->Cell(25,4,"Sub Total ( USD )",B,0,"C");
	$pdf->Cell(155,4,"",0,0,"C");
	$sub_total_nrb_share=number_format(($row_cnt) * ($ipo_market_lot));
	$pdf->Cell(55,4,"$sub_total_nrb_share",B,0,"C");
	$sub_total_nrb_usd=number_format(($ipo_price_per_lot_usd) * ($row_cnt),2);
	$pdf->Cell(30,4,"$sub_total_nrb_usd",B,1,"C");
	
	$pdf->Cell(5,4,"",0,0,"C");
	$pdf->Cell(25,4,"Grand Total",B,0,"C");
	$pdf->Cell(155,4,"NRB",0,0,"R");
	$pdf->Cell(55,4,"$sub_total_nrb_share",B,1,"C");
}
$pdf->AliasNbPages();
$pdf->addPage('L');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(200,4,"$name",0,1,"C");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(300,4," ",0,1,"C");
$ipo_name="\n".$ipo_full_name."\n";
$pdf->Cell(200,4,"$ipo_name",0,1,"C");
$pdf->SetFont('Arial','',8);
$pdf->Cell(200,4,"Catagory Of Applicant : NRB",0,1,"C");
$pdf->SetFont('Arial','B',8);
$sql3 = "select * from application WHERE client_catagory='NRB' AND app_currency='GBP'";
$result3 = $conn->query($sql3);
		$pdf->Cell(10,4,"SL#",1,0,"C");
		 $pdf->Cell(15,4,"TREC NO",1,0,"C");
         $pdf->Cell(10,4,"DPID",1,0,"C");
         $pdf->Cell(20,4,"Customer ID",1,0,"C");
	
	
         $pdf->Cell(50,4,"Applicant's Name",1,0,"C");
		
	
         $pdf->Cell(30,4,"BOID No",1,0,"C");
		
		 $pdf->Cell(15,4,"Catagory",1,0,"C");
		 $pdf->Cell(15,4,"Currency",1,0,"C");
		 $pdf->Cell(15,4,"Amount",1,0,"C");
		 $pdf->Cell(15,4,"Draft No",1,0,"C");
		 $pdf->Cell(15,4,"Bank Name",1,0,"C");
		 $pdf->Cell(30,4,"Branch Name",1,0,"C");
		 $pdf->Cell(15,4,"Date",1,0,"C");
		 $pdf->Cell(15,4,"Remarks",1,1,"C");
if ($result3->num_rows > 0) {
    // output data of each row
    $row_cnt3 = $result3->num_rows;
		$sl=1;
		$pdf->SetFont('Arial','',8);
    while($row = $result3->fetch_assoc()) {
		$pdf->Cell(10,4,"$sl",1,0,"C");
		$pdf->Cell(15,4,"$info_company_trec_no",1,0,"C");
        $pdf->Cell(10,4,"$info_company_dp_no",1,0,"C");
        $show1=$row["client_code"];
        $pdf->Cell(20,4,"$show1",1,0,"C");
	
		$show2=$row["client_name"];
        $pdf->Cell(50,4,"$show2",1,0,"C");
		
		$show3=$row["client_boid"];
        $pdf->Cell(30,4,"$show3",1,0,"C");
		$show4=$row["client_catagory"];
        $pdf->Cell(15,4,"$show4",1,0,"C");
		$ipo_market_lot1=$ipo_market_lot;
		$pdf->Cell(15,4,"GBP",1,0,"C");
		$pdf->Cell(15,4,"$ipo_price_per_lot_gbp",1,0,"C");
		$app_draft_no=$row["app_draft_no"];
		$pdf->Cell(15,4,"$app_draft_no",1,0,"C");
		$client_nrb_bank=$row["client_nrb_bank"];
		$pdf->Cell(15,4,"$client_nrb_bank",1,0,"C");
		$client_nrb_bank_branch=$row["client_nrb_bank_branch"];
		$pdf->Cell(30,4,"$client_nrb_bank_branch",1,0,"C");
		$app_date=$row["app_date"];
		$pdf->Cell(15,4,"$app_date",1,0,"C");
		
		$pdf->Cell(15,4,"$ipo_script_cse",1,1,"C");
		
		$sl=$sl + 1;
    } 
	$pdf->Cell(5,4,"",0,0,"C");
	$pdf->Cell(25,4,"Sub Total ( GBP )",B,0,"C");
	$pdf->Cell(155,4,"",0,0,"C");
	$sub_total_nrb_share=number_format(($row_cnt3) * ($ipo_market_lot));
	$pdf->Cell(55,4,"$sub_total_nrb_share",B,0,"C");
	$sub_total_nrb_usd=number_format(($ipo_price_per_lot_gbp) * ($row_cnt3),2);
	$pdf->Cell(30,4,"$sub_total_nrb_usd",B,1,"C");
	
	$pdf->Cell(5,4,"",0,0,"C");
	$pdf->Cell(25,4,"Grand Total",B,0,"C");
	$pdf->Cell(155,4,"NRB",0,0,"R");
	$pdf->Cell(55,4,"$sub_total_nrb_share",B,1,"C");
}
$pdf->AliasNbPages();
$pdf->addPage('L');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(200,4,"$name",0,1,"C");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(300,4," ",0,1,"C");
$ipo_name="\n".$ipo_full_name."\n";
$pdf->Cell(200,4,"$ipo_name",0,1,"C");
$pdf->SetFont('Arial','',8);
$pdf->Cell(200,4,"Catagory Of Applicant : NRB",0,1,"C");
$pdf->SetFont('Arial','B',8);
$sql4 = "select * from application WHERE client_catagory='NRB' AND app_currency='EUR'";
$result4 = $conn->query($sql4);
		$pdf->Cell(10,4,"SL#",1,0,"C");
		 $pdf->Cell(15,4,"TREC NO",1,0,"C");
         $pdf->Cell(10,4,"DPID",1,0,"C");
         $pdf->Cell(20,4,"Customer ID",1,0,"C");
	
	
         $pdf->Cell(50,4,"Applicant's Name",1,0,"C");
		
	
         $pdf->Cell(30,4,"BOID No",1,0,"C");
		
		 $pdf->Cell(15,4,"Catagory",1,0,"C");
		 $pdf->Cell(15,4,"Currency",1,0,"C");
		 $pdf->Cell(15,4,"Amount",1,0,"C");
		 $pdf->Cell(15,4,"Draft No",1,0,"C");
		 $pdf->Cell(15,4,"Bank Name",1,0,"C");
		 $pdf->Cell(30,4,"Branch Name",1,0,"C");
		 $pdf->Cell(15,4,"Date",1,0,"C");
		 $pdf->Cell(15,4,"Remarks",1,1,"C");
if ($result4->num_rows > 0) {
    // output data of each row
    $row_cnt4 = $result4->num_rows;
		$sl=1;
		$pdf->SetFont('Arial','',8);
    while($row = $result4->fetch_assoc()) {
		$pdf->Cell(10,4,"$sl",1,0,"C");
		$pdf->Cell(15,4,"$info_company_trec_no",1,0,"C");
        $pdf->Cell(10,4,"$info_company_dp_no",1,0,"C");
        $show1=$row["client_code"];
        $pdf->Cell(20,4,"$show1",1,0,"C");
	
		$show2=$row["client_name"];
        $pdf->Cell(50,4,"$show2",1,0,"C");
		
		$show3=$row["client_boid"];
        $pdf->Cell(30,4,"$show3",1,0,"C");
		$show4=$row["client_catagory"];
        $pdf->Cell(15,4,"$show4",1,0,"C");
		$ipo_market_lot1=$ipo_market_lot;
		$pdf->Cell(15,4,"EUR",1,0,"C");
		$pdf->Cell(15,4,"$ipo_price_per_lot_eur",1,0,"C");
		$app_draft_no=$row["app_draft_no"];
		$pdf->Cell(15,4,"$app_draft_no",1,0,"C");
		$client_nrb_bank=$row["client_nrb_bank"];
		$pdf->Cell(15,4,"$client_nrb_bank",1,0,"C");
		$client_nrb_bank_branch=$row["client_nrb_bank_branch"];
		$pdf->Cell(30,4,"$client_nrb_bank_branch",1,0,"C");
		$app_date=$row["app_date"];
		$pdf->Cell(15,4,"$app_date",1,0,"C");
		
		$pdf->Cell(15,4,"$ipo_script_cse",1,1,"C");
		$sl=$sl + 1;
    } 
	$pdf->Cell(5,4,"",0,0,"C");
	$pdf->Cell(25,4,"Sub Total ( EUR )",B,0,"C");
	$pdf->Cell(155,4,"",0,0,"C");
	$sub_total_nrb_share=number_format(($row_cnt4) * ($ipo_market_lot));
	$pdf->Cell(55,4,"$sub_total_nrb_share",B,0,"C");
	$sub_total_nrb_eur=number_format(($ipo_price_per_lot_eur) * ($row_cnt4),2);
	$pdf->Cell(30,4,"$sub_total_nrb_eur",B,1,"C");
	
	$pdf->Cell(5,4,"",0,0,"C");
	$pdf->Cell(25,4,"Grand Total",B,0,"C");
	$pdf->Cell(155,4,"NRB",0,0,"R");
	$pdf->Cell(55,4,"$sub_total_nrb_share",B,1,"C");
}
ob_end_clean(); //if Fatal error: Uncaught exception 'Exception' with message 'FPDF error: Some data has already been output, can't send PDF file'
$pdf->Output();

$conn->close();
?>
<?php
/*ob_start();
require_once('fpdf/fpdf.php');
$pdf=new FPDF();



$pdf->AddPage();
$pdf->SetFont("Arial","B","20");
$pdf->Cell(0,10,$data); 
$pdf->Output();
ob_end_flush();
	
*/	


?>
