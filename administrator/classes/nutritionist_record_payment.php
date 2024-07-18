<?php
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['recordpayment'])) {
  include 'users.class.php';
  $user = new ManageUsers();


  $staffid = $_POST['staffid'];
  $totalrevenue = $_POST['totalrevenue'];
  $paidamount = $_POST['amount'];
  $balance = $_POST['balance'];
  $transactioncode = $_POST['transactioncode'];
  $ip_address = $_SERVER['REMOTE_ADDR'];
  $date = date("d-m-Y");
  $time = date("H:i");

  $payment_record = $user->CheckPayment($staffid,$transactioncode);
  if ($payment_record == 0) {

    $record_transaction = $user->RecordTransation($staffid,$totalrevenue,$paidamount,$balance,$transactioncode,$ip_address,$date,$time);
      if ($record_transaction == 1) {
          header("Location: ../nutritionist_performance_details?view=$staffid&s=Transaction Recorded!.");
          exit();
          }

  }
  else{
    header("Location: ../nutritionist_record_payment?view=$staffid&amount=$totalrevenue&e=Similar Transaction Exists!.");
    exit();
  }


}