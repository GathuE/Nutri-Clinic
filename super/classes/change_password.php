<?php
error_reporting(E_ALL & E_NOTICE);
ini_set('display_errors', 1);

if (isset($_POST['changepassword'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $id = $_POST['user_id'];
  $password = md5($_POST['password']);
  $confirm_password = md5($_POST['confirm_password']);

  if (empty($password) || empty($confirm_password)) {
    header("Location: ../change_password?e=Missing Fields!!");
    exit();
  }elseif ($password !== $confirm_password) {
    header("Location: ../change_password?e=Passwords Don't Match.");
    exit();
  }
  else{
        $password_update = $user->UpdatePassword($password);
        if ($password_update == 1) {
            header("Location: ../profile?s=Update Successful!.");
            exit();
          }
          else{
            header("Location: ../change_password?e=Try a Different Password!!");
            exit();
          }
  }

}
  
?>