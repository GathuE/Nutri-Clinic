<?php
error_reporting(E_ALL & E_NOTICE);
ini_set('display_errors', 1);

if (isset($_POST['updateaccount'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $id = $_POST['staffid'];
  $email = $_POST['staffemail'];
  $status = $_POST['staffstatus'];

  //Check for both the Activated and Deactivated Status

  $active_status = $user->CheckActiveStatus($id);
  $inactive_status = $user->CheckInactiveStatus($id);

  //If Active, then Deactivate

  if($active_status == 1 && $inactive_status == 0 ){
    $deactivate_status = $user->DeactivateStatus($id);
    if ($deactivate_status == 1) {
      header("Location: ../users?s=Successfully Deactivated.");
      exit();
    }else{
      header("Location: ../users?e=Not Successfully Deactivated.");
      exit();
    }
  }
  
  //If Not Active, the Activate

  else if($active_status == 0 && $inactive_status == 1 ){
    $activate_status = $user->ActivateStatus($id);
    if ($activate_status == 1) {
      header("Location: ../users?s=Successfully Activated.");
      exit();
    }else{
      header("Location: ../users?e=Not Successfully Activated.");
      exit();
    }
  }

}

