<?php
error_reporting(E_ALL & E_NOTICE);

//Timezone
date_default_timezone_set('Africa/Nairobi');

//Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'cCeeJ.7Ol/YZpArA';
$db = 'nutrition_system_2021';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $db) or die($conn); 
 
$code = mysqli_real_escape_string($conn, $_POST['code']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$problem = mysqli_real_escape_string($conn, $_POST['problem']);
$etiology = mysqli_real_escape_string($conn, $_POST['etiology']);
$symptoms = mysqli_real_escape_string($conn, $_POST['symptoms']);
$ip_address = $_SERVER['REMOTE_ADDR'];
$date = date("d-m-Y");
$time = date("H:i");


$duplicate_entry = mysqli_query($conn, "select * from walkin_clientdiagnosis where client_code='$code' and problem_statement='$problem' and etiology='$etiology' and symptoms='$symptoms'");

if (mysqli_num_rows($duplicate_entry)>0)
{
    echo json_encode(array("statusCode"=>201));
}
else{
    $sql = "INSERT INTO `walkin_clientdiagnosis` (`client_code`, `client_name`, `client_phone`, `problem_statement`, `etiology`, `symptoms`, `ip_address`, `date`, `time`) VALUES ('$code','$name', '$phone', '$problem', '$etiology', '$symptoms', '$ip_address', '$date', '$time')";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array("statusCode"=>200));
    }
    else {
        echo json_encode(array("statusCode"=>201));
    }
}
mysqli_close($conn);
?>