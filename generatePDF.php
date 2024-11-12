<?php                
require_once('inc/config/constants.php');
require_once('inc/config/db.php');
include_once('tcpdf/tcpdf.php');

$invoiceNum = $_GET['invID'];

$saleDetailsSearchSql = 'SELECT sale.*, customer.*
    FROM sale
    JOIN customer ON sale.customerID = customer.customerID
    WHERE sale.saleID = :saleID';
$saleDetailsSearchStatement = $conn->prepare($saleDetailsSearchSql);
$saleDetailsSearchStatement->execute(['saleID' => $invoiceNum]);

if($saleDetailsSearchStatement->rowCount() > 0) {

	$row = $saleDetailsSearchStatement->fetch(PDO::FETCH_ASSOC);

	//----- Code for generate pdf
	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);  
	//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	$pdf->SetDefaultMonospacedFont('helvetica');  
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
	$pdf->setPrintHeader(false);  
	$pdf->setPrintFooter(false);  
	$pdf->SetAutoPageBreak(TRUE, 10);  
	$pdf->SetFont('helvetica', '', 12);  
	$pdf->AddPage(); //default A4
	//$pdf->AddPage('P','A5'); //when you require custome page size 
	
	$content = '';

$content .= '
<style type="text/css">
    body {
        font-size: 14px;
        line-height: 1.6;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: #333;
    }
    .invoice-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }
    .invoice-header {
        text-align: center;
        padding: 10px 0;
    }
    .invoice-header h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }
    .invoice-header p {
        margin: 5px 0;
        color: #666;
    }
    .invoice-details, .invoice-footer {
        width: 100%;
        margin-top: 20px;
        border-top: 2px solid #eee;
        padding-top: 10px;
    }
    .invoice-details td {
        padding: 5px 10px;
        vertical-align: top;
    }
    .invoice-details td.label {
        font-weight: bold;
        color: #555;
    }
    .items-table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }
    .items-table th, .items-table td {
        padding: 10px;
        border: 1px solid #eee;
        text-align: left;
    }
    .items-table th {
        background: #f8f8f8;
        color: #333;
        font-weight: bold;
    }
    .items-table .total-row td {
        font-weight: bold;
        border-top: 2px solid #ddd;
        font-size: 16px;
    }
    .invoice-footer {
        text-align: center;
        color: #777;
        font-size: 12px;
        margin-top: 20px;
    }
</style>

<div class="invoice-container">
    <div class="invoice-header">
        <h1>Jasdy Office Supplies Trading</h1>
        <p>Contact No: +63 123 4567 890 | Website: https://jasdyofficesupplies.shop/</p>
        <p><strong>Invoice</strong></p>
    </div>

    <table class="invoice-details">
        <tr>
            <td class="label">Customer Name:</td>
            <td>'.$row['customerName'].'</td>
            <td class="label" style="text-align:right;">Invoice Date:</td>
            <td style="text-align:right;">'.date("d-m-Y").'</td>
        </tr>
        <tr>
            <td class="label">Mobile No:</td>
            <td>'.$row['mobile'].'</td>
            <td class="label" style="text-align:right;">Invoice No:</td>
            <td style="text-align:right;">'.$_GET['invID'].'</td>
        </tr>
    </table>

    <table class="items-table">
        <tr>
            <th>Items</th>
            <th style="text-align:right;">Amount</th>
        </tr>';

$total = $row['quantity'] * $row['unitPrice'];

$content .= '
        <tr>
            <td>
                <strong>'.$row['itemName'] . ' (' . $row['quantity'] . 'x)</strong>
                <br>
                <span style="color: #888; font-size: 12px;">Brand New</span>
            </td>
            <td style="text-align:right;">PHP '.number_format($row['unitPrice'], 2).'</td>
        </tr>';

$content .= '
        <tr class="total-row">
            <td style="text-align:right;">GRAND TOTAL:</td>
            <td style="text-align:right;">PHP '.number_format($total, 2).'</td>
        </tr>';

// Assuming $cashReceived is the amount the buyer paid
// Calculate change
$cashReceived = $row['payment']; // Example: amount buyer paid

$content .= '
    </table>

    <div class="invoice-footer">
        <p>Payment Mode: '. $cashReceived . '</p>
        <p><strong>Thank you for your business!</strong></p>
    </div>
</div>';


    $pdf->writeHTML($content);

    $datetime=date('dmY_hms');
    $file_name = "INV_".$datetime.".pdf";
    ob_end_clean();

    if($_GET['ACTION']=='VIEW') {
        $pdf->Output($file_name, 'I'); // I means Inline view
    } 
} else {
	echo 'Record not found for PDF.';
}
