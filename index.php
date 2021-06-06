<?php
// Include the main TCPDF library (search for installation path).
require_once 'tcpdf/tcpdf.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

  //Page header
  public function Header() {
    // Logo
    $image_file = K_PATH_IMAGES.'logo1.png';
    $this->Image($image_file, 10, 10, 30, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Set font
    $this->SetFont('helvetica', 'B', 20);
    // Title
    $this->Cell(0, 15, '<< Vogusov PDF >>', 0, false, 'L', 0, '', 0, false, 'M', 'M');
  }

  // Page footer
  public function Footer() {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator('VogusCreator');
$pdf->SetAuthor('Vogusov Anton');
$pdf->SetSubject('PDF test project');
$pdf->SetKeywords('PDF, PHP, Test');

// set default header data
$pdf->SetHeaderData(K_PATH_IMAGES.'logo1.png', 50, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// content
$html = <<< "CONT"
<p>Test Test Test Test Test Test
        Test Test Test Test 
Test Test Test Test Test Test
  Test Test Test Test</p>
  <p>Test Test Test Test Test Test
        Test Test Test Test 
Test Test Test Test Test Test
  Test Test Test Test</p>
  <p>Test Test Test Test Test Test
        Test Test Test Test 
Test Test Test Test Test Test
  Test Test Test Test</p><p>Test Test Test Test Test Test
        Test Test Test Test 
Test Test Test Test Test Test
  Test Test Test Test</p><p>Test Test Test Test Test Test
        Test Test Test Test 
Test Test Test Test Test Test
  Test Test Test Test</p><p>Test Test Test Test Test Test
        Test Test Test Test 
Test Test Test Test Test Test
  Test Test Test Test</p><p>Test Test Test Test Test Test
        Test Test Test Test 
Test Test Test Test Test Test
  Test Test Test Test</p>
<!--  <img src="img/logo.png">-->
  
  
CONT;

//$pdf->Write(0, $html, '', 0, 'L', true, 0, false, false, 0);
//$pdf->writeHTMLCell(0,0, '', '',$html, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0,0, '', '',$html, 0, 1, 0, true, '', true);

$pdf->SetAlpha(0.2);
$pdf->Image("img/logo.png", '0','30', $w=100, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='C', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array());

// opacity


$pdf->Output('myTestPDF.pdf', 'D');



