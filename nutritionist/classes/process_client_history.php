<?php
error_reporting(E_ALL & E_NOTICE);
ini_set('display_errors', 1);

if (isset($_POST['save_history'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $clientid = $_POST['client_id'];
  $clientname = $_POST['client_name'];
  $clientphone = $_POST['client_phone'];
  $pc = $_POST['pc'];
  $hpc = $_POST['hpc'];
  $mhx = $_POST['mhx'];
  $fmhx = $_POST['fmhx'];
  $shx = $_POST['shx'];
  $dhx = $_POST['dhx'];
  $ip_address = $_SERVER['REMOTE_ADDR'];
  $date = date("d-m-Y");
  $time = date("H:i");

  $history_record = $user->CheckHistory($clientid,$clientname,$clientphone);
  if ($history_record == 0) {
    $save_history = $user->SaveHistory($clientid,$clientname,$clientphone,$pc,$hpc,$mhx,$fmhx,$shx,$dhx,$ip_address,$date,$time);
      if ($save_history == 1) {
          header("Location: ../proceed_assessment?view=$clientid&s=History Saved!!.");
          exit();
          }
          else{
            header("Location: ../start_assessment?view=$clientid&e=History Exists!!.");
            exit();
          }
  }
  else{
    $update_history = $user->UpdateHistory($clientname,$clientphone,$pc,$hpc,$mhx,$fmhx,$shx,$dhx,$ip_address,$date,$time);
    if ($update_history == 1) {
        header("Location: ../proceed_assessment?view=$clientid&s=History Updated!!.");
        exit();
        }
        else{
          header("Location: ../start_assessment?view=$clientid&e=History Exists!!.");
          exit();
        }
    
  }


}