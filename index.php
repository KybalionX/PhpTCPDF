<?php

require __DIR__ . '/vendor/autoload.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData("academica.png", 15, "Colpegasus", "Header de ejemplo\nSunny", array(51, 90, 255), array(255, 119, 51));

// set footer colors
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect

// Set some content to print
/*
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

*/

$pdf->Cell(180, 10, "Información requerida", 1, 0, 'C', false, '', 5);
$pdf->Ln();
$pdf->Cell(45, 10, "Nombre del docente:", 1, 0, 'L', false, '', 5);
$pdf->Cell(135, 10, "Paco Antonio de la Concordia", 1, 0, 'L', false, '', 5);
$pdf->Ln();
$pdf->Cell(60, 10, "2018", 1, 0, 'L', false, '', 5);
$pdf->Cell(60, 10, "Ingeniería en Sistemas", 1, 0, 'L', false, '', 5);
$pdf->Cell(60, 10, "6° Semestre", 1, 0, 'L', false, '', 5);
$pdf->Ln();
$pdf->Cell(180, 15, "Tabla", 0, 0, 'C', false, '', 5);
$pdf->Ln();
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
#$pdf->Output('example_001.pdf', 'I');

$file = file_get_contents('MOCK_DATA.json');
$data = json_decode($file, true);

$table = '
<table>
    <tr class="headers">
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>email</th>
    </tr>
';

foreach ($data as $element) {
    $table .= "
    <tr>
     <td>$element[id]</td>
         <td>$element[first_name]</td>
        <td>$element[last_name]</td>
         <td>$element[email]</td>
     </tr>
     ";
}

$table .= "</table>


<style>

  td,  th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  table th {
    padding: 12px;
    text-align: center;
    background-color: #04AA6D;
    color: white;
  }


</style>

";


$pdf->writeHTMLCell(180, 10, '', '', $table);

$pdf->Output("Document.pdf");
//============================================================+
// END OF FILE
//============================================================+