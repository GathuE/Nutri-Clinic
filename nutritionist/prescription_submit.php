<?php
error_reporting(E_ALL & E_NOTICE);

//Timezone
date_default_timezone_set('Africa/Nairobi');

//Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = 'nutrition_system_2024';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $db) or die($conn); 
 
$client_refno = mysqli_real_escape_string($conn, $_POST['client_refno']);
$prescription_one = mysqli_real_escape_string($conn, $_POST['prescription_one']);
$prescription_two = mysqli_real_escape_string($conn, $_POST['prescription_two']);
$prescription_three = mysqli_real_escape_string($conn, $_POST['prescription_three']);
$prescription_four = mysqli_real_escape_string($conn, $_POST['prescription_four']);
$prescription_five = mysqli_real_escape_string($conn, $_POST['prescription_five']);
$prescription_six = mysqli_real_escape_string($conn, $_POST['prescription_six']);
$ip_address = $_SERVER['REMOTE_ADDR'];
$date = date("d-m-Y");
$time = date("H:i");


$duplicate_entry = mysqli_query($conn, "select * from walkin_clientprescription where client_refno='$client_refno' and (prescription_one='$prescription_one' or prescription_two='$prescription_two' or prescription_three='$prescription_three' or prescription_four='$prescription_four' or prescription_five='$prescription_five' or prescription_six='$prescription_six')");

if (mysqli_num_rows($duplicate_entry)>0)
{

    $sql1 = "UPDATE walkin_clientprescription SET prescription_one = '$prescription_one', prescription_two = '$prescription_two', prescription_three = '$prescription_three', prescription_four = '$prescription_four', prescription_five = '$prescription_five', prescription_six = '$prescription_six' WHERE client_refno = '$client_refno'";
    if(mysqli_query($conn, $sql1)){
        echo json_encode(array("statusCode"=>202));
    }
    else{
        echo json_encode(array("statusCode"=>201));
    }
    
}
else{
    $sql = "INSERT INTO `walkin_clientprescription` (`client_refno`, `prescription_one`, `prescription_two`, `prescription_three`, `prescription_four`, `prescription_five`, `prescription_six`, `ip_address`, `date`, `time`) VALUES ('$client_refno','$prescription_one', '$prescription_two', '$prescription_three', '$prescription_four', '$prescription_five', '$prescription_six', '$ip_address', '$date', '$time')";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array("statusCode"=>200));
    }
    else {
        echo json_encode(array("statusCode"=>201));
    }
}
mysqli_close($conn);
?>