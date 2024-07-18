<?php
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['registerclient'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $status = $_POST['status'];
  $clientname = $_POST['clientname'];
  $clientphonenumber = $_POST['clientphonenumber'];
  $service = $_POST['service'];
  $cost = $_POST['servicecost'];
  $paymentmode = $_POST['optionsRadios'];
  $transactioncode = $_POST['mpesacode'];
  $ip_address = $_SERVER['REMOTE_ADDR'];
  $date = date("d-m-Y");
  $time = date("H:i");


  $client_record = $user->CheckClient($clientphonenumber,$service,$date);
  if ($client_record == 0) {

      $enroll_client = $user->EnrollClient($status,$clientname,$clientphonenumber,$service,$cost,$paymentmode,$transactioncode,$ip_address,$time,$date);
      if ($enroll_client == 1) {
          header("Location: ../clients?s=Transaction Recorded!!.");
          exit();
          }
    }
    else{
      header("Location: ../new_walkin_client?e=Similar Record Exists!!.");
      exit();
    }

}
  
?>