<?php
session_start();
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['login'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  if (empty($email) || empty($password)) {
    header("Location: ../index?e=Please Provide your Login Details.");
    exit();
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../login?e=The Username Entered is not valid.");
    exit();
  } else {
    $check_status = $user->Checkstatus($email, $password);
    if ($check_status == 1){
      $super_role = $user->CheckSuperAdmin($email);
      $admin_role = $user->CheckAdmin($email);
      $receptionist_role = $user->CheckReceptionist($email);
      $nutritionist_role = $user->CheckNutritionist($email);

      if($super_role == 1 && $admin_role == 0 && $receptionist_role == 0 && $nutritionist_role == 0){
        $login_user = $user->Login($email, $password);
            if ($login_user == 1) {
              $create_session = $user->create_session($email);
              header("Location: ../super/dashboard?s=Successfully logged in.");
              exit();
            } else {
              header("Location: ../index?e=Incorrect Login Details!.");
              exit();
            }
      }else if($super_role == 0 && $admin_role == 1 && $receptionist_role == 0 && $nutritionist_role == 0){
        $login_user = $user->Login($email, $password);
            if ($login_user == 1) {
              $create_session = $user->create_session($email);
              header("Location: ../administrator/dashboard?s=Successfully logged in.");
              exit();
            } else {
              header("Location: ../index?e=Incorrect Login Details!.");
              exit();
            }

      }else if($super_role == 0 && $admin_role == 0 && $receptionist_role == 1 && $nutritionist_role == 0){
        $login_user = $user->Login($email, $password);
            if ($login_user == 1) {
              $create_session = $user->create_session($email);
              header("Location: ../receptionist/dashboard?s=Successfully logged in.");
              exit();
            } else {
              header("Location: ../index?e=Incorrect Login Details!.");
              exit();
            }

      }else if($super_role == 0 && $admin_role == 0 && $receptionist_role == 0 && $nutritionist_role == 1){
        $login_user = $user->Login($email, $password);
            if ($login_user == 1) {
              $create_session = $user->create_session($email);
              header("Location: ../nutritionist/dashboard?s=Successfully logged in.");
              exit();
            } else {
              header("Location: ../index?e=Incorrect Login Details!.");
              exit();
            }

      }



            
    }
    elseif($check_status == 0)
    {
      $login_user = $user->Login($email, $password);
      if ($login_user == 1) {
        header("Location: ../index?e=Your Account is not Active!!.");
        exit();
      } else {
        header("Location: ../index?e=Incorrect Login Details!.");
        exit();
      }
    }
   
    else{
      header("Location: ../index?e=Incorrect Login Details!.");
          exit();
    }

   
    
  }
}

