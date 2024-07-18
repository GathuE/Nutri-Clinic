<?php
session_start();
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['newpassword'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $id = $_POST['user_id'];
  $role = $_POST['user_role'];
  $email = md5($_POST['user_email']);

  
  $newpassword= md5($_POST['new_password']);
  $confirmpassword = md5($_POST['confirm_password']);

  if ($newpassword !== $confirmpassword) {
    $create_reset_session = $user->create_reset_session($role);
    header("Location: ../new_password?e=Your Passwords do not Match!.");
    exit();
  }
  else {

    $password_update = $user->UpdatePassword($newpassword);
        if ($password_update == 1) {
            header("Location: ../index?s=Password Updated Successfully!.");
            exit();
          }
          else{
            $create_reset_session = $user->create_reset_session($role);
            header("Location: ../new_password?e=Try a Different Password!!");
            exit();
          }

}

}