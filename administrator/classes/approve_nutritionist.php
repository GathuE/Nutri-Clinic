<?php
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['approve'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $userid = $_POST['userid'];
  $name = $_POST['username'];


  $approval_status = $user->CheckNutritionistApproval($userid);

  if ($approval_status == 0) {

    $approve_nutritionist = $user->ApproveNutritionist($userid);
      if ($approve_nutritionist == 1) {
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
  
  
    $reject_status = $user->RejectStatus($userid);
  
    if ($reject_status == 0) {
  
      $reject_nutritionist = $user->RejectNutritionist($userid);
        if ($reject_nutritionist == 1) {
            header("Location: ../users?s=$name Rejected!!.");
            exit();
            }
  
    }
    else{
      header("Location: ../users?e=$name Already Rejected!.");
      exit();
    }
  
  
  
  
  }