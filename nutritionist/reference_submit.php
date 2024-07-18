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
 
$code = mysqli_real_escape_string($conn, $_POST['client_ref']);
$phone = mysqli_real_escape_string($conn, $_POST['client_tel']);
$name = mysqli_real_escape_string($conn, $_POST['client_name']);
$formula = mysqli_real_escape_string($conn, $_POST['formula']);
$activity_factor = mysqli_real_escape_string($conn, $_POST['activity_factor']);
$energy = mysqli_real_escape_string($conn, $_POST['energy']);
$protein = mysqli_real_escape_string($conn, $_POST['protein']);
$fat = mysqli_real_escape_string($conn, $_POST['fat']);
$carbohydrate = mysqli_real_escape_string($conn, $_POST['carbohydrate']);
$water = mysqli_real_escape_string($conn, $_POST['water']);
$fibre = mysqli_real_escape_string($conn, $_POST['fibre']);
$calcium = mysqli_real_escape_string($conn, $_POST['calcium']);
$iron = mysqli_real_escape_string($conn, $_POST['iron']);
$magnesium = mysqli_real_escape_string($conn, $_POST['magnesium']);
$phosphorous = mysqli_real_escape_string($conn, $_POST['phosphorous']);
$potassium = mysqli_real_escape_string($conn, $_POST['potassium']);
$sodium = mysqli_real_escape_string($conn, $_POST['sodium']);
$zinc = mysqli_real_escape_string($conn, $_POST['zinc']);
$selenium = mysqli_real_escape_string($conn, $_POST['selenium']);
$vitarae = mysqli_real_escape_string($conn, $_POST['vitarae']);
$vitare = mysqli_real_escape_string($conn, $_POST['vitare']);
$retinol = mysqli_real_escape_string($conn, $_POST['retinol']);
$bcarotene = mysqli_real_escape_string($conn, $_POST['bcarotene']);
$thiamin = mysqli_real_escape_string($conn, $_POST['thiamin']);
$riboflavin = mysqli_real_escape_string($conn, $_POST['riboflavin']);
$niacin = mysqli_real_escape_string($conn, $_POST['niacin']);
$dietaryfolate = mysqli_real_escape_string($conn, $_POST['dietaryfolate']);
$foodfolate = mysqli_real_escape_string($conn, $_POST['foodfolate']);
$vitb12 = mysqli_real_escape_string($conn, $_POST['vitb12']);
$vitc = mysqli_real_escape_string($conn, $_POST['vitc']);
$cholestrol = mysqli_real_escape_string($conn, $_POST['cholestrol']);
$oxalicacid = mysqli_real_escape_string($conn, $_POST['oxalicacid']);
$phytate = mysqli_real_escape_string($conn, $_POST['phytate']);
$ip_address = $_SERVER['REMOTE_ADDR'];
$date = date("d-m-Y");
$time = date("H:i");


$duplicate_entry = mysqli_query($conn, "select * from walkin_referencedata where client_ref='$code' and client_tel='$phone' and client_name='$name' and formula='$formula'");

if (mysqli_num_rows($duplicate_entry)>0)
{
    echo json_encode(array("statusCode"=>201));
}
else{
    $sql = "INSERT INTO `walkin_referencedata` (`client_ref`, `client_tel`, `client_name`, `formula`, `activity_factor`, `energy`, `protein`, `fat`, `carbohydrate`, `water`, `fibre`, `calcium`, `iron`, `magnesium`, `phosphorous`, `potassium`, `sodium`, `zinc`, `selenium`,`vitarae`,`vitare`,`retinol`,`bcarotene`,`thiamin`,`riboflavin`,`niacin`,`dietaryfolate`,`foodfolate`,`vitb12`,`vitc`,`cholestrol`,`oxalicacid`,`phytate`,`ip_address`,`date`,`time`) VALUES ('$code','$phone', '$name', '$formula', '$activity_factor', '$energy', '$protein', '$fat', '$carbohydrate', '$water', '$fibre', '$calcium', '$iron', '$magnesium', '$phosphorous', '$potassium', '$sodium', '$zinc', '$selenium', '$vitarae', '$vitare', '$retinol', '$bcarotene', '$thiamin', '$riboflavin', '$niacin', '$dietaryfolate', '$foodfolate', '$vitb12', '$vitc', '$cholestrol', '$oxalicacid', '$phytate', '$ip_address', '$date', '$time')";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array("statusCode"=>200));
    }
    else {
        echo json_encode(array("statusCode"=>201));
    }
}
mysqli_close($conn);
?>
 



