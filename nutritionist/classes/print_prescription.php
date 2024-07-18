<?php
  $conn = mysqli_connect('localhost','root','cCeeJ.7Ol/YZpArA');
  mysqli_select_db($conn,'nutrition_system_2021');
// Include the main TCPDF library (search for installation path).
include('../tcpdf/tcpdf.php');


if(isset($_POST['submit'])){
    $client_code = $_POST['client_refno'];
	
// create new PDF document
$pdf = new TCPDF('P','mm','A5');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetMargins(4, -5, 4, true);
$pdf->AddPage();



	
	$html .='<table border ="0" cellspacing="0" style="font-size:10px;">
	<tr>
		<td style="width:20%">
			<table >
				<tr>
					<td style="float:right;"><img src ="../img/logo.png" style="height:60px;"> </td>
				</tr>
			</table>
		</td>
		
		<td style ="width:80%;font-size:9px;text-align:right;">
				<tr>
					<td style ="font-size:9px;">
						<p><b style="font-size:12px;">Firm Name </b>
							<br>
								<small> Nutrition & Dietetics Consultants </small>  
							<br> 
								R.D., R.C.N., R.P.H.N., R.C.H.N., R.D.T.
						</p>
					</td>
				</tr>
		</td>
	</tr>';
	$html .='</table>';
	$html .='<hr style="width:400px;">';
	$html .='<table border ="0" cellspacing="0" style="font-size:10px;">
	<tr>
		<td style ="width:100%;font-size:9px;text-align:center;">
				<tr>
					<td style ="font-size:9px;">
						<p>PRESCRIPTION</p>
					</td>
				</tr>
		</td>
	</tr>';


	// Generate from database
	$query = mysqli_query($conn,"SELECT * from walkin_clientprescription WHERE client_refno='$client_code'");
	while($row = mysqli_fetch_assoc($query))
	{


	
		// Table One
	$html .= '<table border ="0" cellspacing="0" style="font-size:10px;text-align:left;">
	<tr>
		<td>'.$row["prescription_one"].'</td>
	</tr>
	<tr>
		<td>'.$row["prescription_two"].'</td>
	</tr>
	<tr>
		<td>'.$row["prescription_three"].'</td>
	</tr>
	<tr>
		<td>'.$row["prescription_four"].'</td>
	</tr>
	<tr>
		<td>'.$row["prescription_five"].'</td>
	</tr>
	<tr>
		<td>'.$row["prescription_six"].'</td>
	</tr>
	';
	
	$html .="</table>";
	
	


	}
	// Generate from database

	$html .="</table>";


$pdf->Ln(12);
$pdf->writeHTML($html);
$title = "Prescription";
 $pdf->SetTitle($title);
ob_end_clean();
$pdf->Output("Client_Prescription.pdf"); //rename your file generated here

}

?>
