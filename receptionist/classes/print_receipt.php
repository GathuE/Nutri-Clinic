<?php
error_reporting(0);
  $conn = mysqli_connect('localhost','root','');
  mysqli_select_db($conn,'nutrition_system_2024');
// Include the main TCPDF library (search for installation path).
include('../tcpdf/tcpdf.php');


if(isset($_POST['submit'])){
    $code = $_POST['client_code'];
	$employee = $_POST['employee_code'];

// create new PDF document
$pdf = new TCPDF('P','mm','G8');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetMargins(4, -5, -4, true);
$pdf->AddPage();



	// Generate from database
	$query = mysqli_query($conn,"SELECT * from walkin_clients WHERE ID='$code'");
	while($row = mysqli_fetch_assoc($query))
	{

	$html .='<table border ="0" cellspacing="0" style="font-weight:bold;">
		<tr>
			<td style="font-size:9px;">Firm Name</td>
		</tr>
		<tr>
			<td style="font-size:6px;">Email : </td>
		</tr>
		<tr>
			<td style="font-size:6px;">Phone : </td>
		</tr>
	</table>';
	$html .='<table border ="0" cellspacing="0" style="font-size:7px;font-weight:bold;">
				<tr>
					<td>CASH RECEIPT</td>
				</tr>
			</table>';
	$html .='<hr style="width:140px;">';
		// Table One
	$html .= '<table border ="0" cellspacing="0" style="font-size:6px;text-align:left;">
	<tr>
		<td>NAME</td>
		<td>'.$row["clientname"].'</td>
	</tr>
	';

	$html .= '
	<tr>
		<td>DATE</td>
		<td>'.$row["date"].'</td>
	</tr>
	';
	
	$html .="</table>";

		// Table Two
	$html .= '<table border ="0" cellspacing="0" style="font-size:6px;text-align:left;">
	<tr>
		<td>PHONE NUMBER</td>
		<td>'.$row["phonenumber"].'</td>
	</tr>
	';

	$html .="</table>";

		// Table Three
	$html .= '<table border ="0" cellspacing="0" style="font-size:6px;text-align:left;">
	<tr>
		<td>SERVICE</td>
		<td>'.$row["service"].'</td>
		
	</tr>
	';
	
	$html .= '
	<tr>
		<td>COST</td>
		<td>'.$row["cost"].'</td>
	</tr>
	';

	$html .="</table>";
	
		// Table Four
	$html .= '<table border ="0" cellspacing="0" style="font-size:6px;text-align:left;">
	<tr>
		<td>PAYMENT-MODE</td>
		<td>'.$row["payment_mode"].'</td>
		
	</tr>
	';

	$html .= '
	<tr>
		<td>MPESA - CODE</td>
		<td>'.$row["mpesa_code"].'</td>
	</tr>
	';

	}
	// Generate from database

	$html .="</table>";

	$html .='<hr style="width:140px;">';
	$html .= '<table border ="0" cellspacing="0" style="font-size:6px;font-weight:bold;">
	<tr>
		<td>You were Served By :'.$employee.'</td>
	</tr>
	';
	$html .="</table>";

$pdf->Ln(12);
$pdf->writeHTML($html);
$title = "Transaction_Receipt";
 $pdf->SetTitle($title);
ob_end_clean();
$pdf->Output("Transaction_Receipt.pdf"); //rename your file generated here

}

?>
