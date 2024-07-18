<?php
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['approve'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $userid = $_POST['userid'];
  $name = $_POST['username'];


  $approval_status = $user->CheckPractitionerApproval($userid);

  if ($approval_status == 0) {

    $approve_practitioner = $user->ApprovePractitioner($userid);
      if ($approve_practitioner == 1) {
          header("Location: ../users?s=$name Approved!!.");
          exit();
          }

  }
  else{
    header("Location: ../users?e=$name Already Approved!.");
    exit();
  }


}

else if (isset($_POST['reject'])) {
    include 'users.class.php';
    $user = new ManageUsers();


    $userid = $_POST['userid'];
    $name = $_POST['username'];
  
  
    $reject_status = $user->RejectPractitionerStatus($userid);
  
    if ($reject_status == 0) {
  
      $reject_practitioner = $user->RejectPractitioner($userid);
        if ($reject_practitioner == 1) {
            header("Location: ../users?s=$name Rejected!!.");
            exit();
            }
  
    }
    else{
      header("Location: ../users?e=$name Already Rejected!.");
      exit();
    }
  
  
  
  
  }