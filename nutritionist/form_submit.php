
<?php
error_reporting(E_ALL & E_NOTICE);
//Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = 'nutrition_system_2024';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $db) or die($conn); 
 

$name = mysqli_real_escape_string($conn, $_POST['name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$code = mysqli_real_escape_string($conn, $_POST['code']);
$meal = mysqli_real_escape_string($conn, $_POST['meal']);
$foodid = mysqli_real_escape_string($conn, $_POST['food']);
$servingsid = mysqli_real_escape_string($conn, $_POST['servingitem']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);


$duplicate_entry = mysqli_query($conn, "select * from walkin_mealhistory where client_no='$code' and meal='$meal' and foods_id='$foodid'");

if (mysqli_num_rows($duplicate_entry)>0)
{
    echo json_encode(array("statusCode"=>201));
}
else{
    $sql = "INSERT INTO `walkin_mealhistory` (`client_no`, `clientname`, `clientphone`, `meal`, `foods_id`, `servings_id`, `amount`) VALUES ('$code','$name', '$phone', '$meal', '$foodid', '$servingsid', '$amount')";
    if(mysqli_query($conn, $sql)){
        echo json_encode(array("statusCode"=>200));
    }
    else {
        echo json_encode(array("statusCode"=>201));
    }
}
mysqli_close($conn);
?>
 