<?php

include '../admin/config/config.php';
include '../admin/phpqrcode/qrlib.php';
require_once('../admin/tcpdf/tcpdf.php');
session_start();
error_reporting(0);
include("../../theme/config.php");

$plant= $_POST['plant'];
$area = $_POST['area'];
$floor = $_POST['floor'];
$dept = $_POST['dept'];


$area1 = str_replace(array('[',']'),'',$area);
$floor1 = str_replace(array('[',']'),'',$floor);
$dept1 = str_replace(array('[',']'),'',$dept);

$area2 = str_replace('"', "'", $area1);
$floor2 = str_replace('"', "'", $floor1);
$dept2 = str_replace('"', "'", $dept1);

//var_dump($_POST);
$id = $_POST['id'];

// create new PDF document
$height_in_mm = 100;
$width_in_mm = 100;
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array($width_in_mm, $height_in_mm), true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('All QR Code Locker');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font     

// add a page

$a= "  SELECT * 
FROM [SERE].[dbo].[tbl_locker_data] 
where plant ='$plant' and (area IN ($area2) OR area is null) and (floor IN ($floor2) OR floor is null) and (dept IN ($dept2) OR dept is null)";

    // echo $a;
$actionsum= sqlsrv_query($conn, $a);
$no=1;
while ($r = sqlsrv_fetch_array($actionsum)) { 

$pdf->AddPage();

// set some text to print
require_once 'phpqrcode/qrlib.php';
$path = 'imgqr/';
$qrcode = $path.time(). $r['locker_id'] .".png";

QRcode::png($r['locker_id'], $qrcode, 'H', 1, 1);

// $txt = "<img src='".$qrcode." 'width='100px' height='100px'>";
// $html = "<img src='imgqr/1677002880PEM001.png' width='100px' height='100px'> $qrcode";
// $pdf->writeHTML($html, true, false, true, faSElse, '');
$pdf->SetLineWidth( 1 );
$pdf->Image($qrcode, $x=26, $y=19, $w=290, $h=290, 'PNG', '', 'T', false, 1000, '', false, false, 1, false, false, false);

// print a block of text using Write()
// $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------
}
//Close and output PDF document
$pdf->Output('All_QR_Code_Locker.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+