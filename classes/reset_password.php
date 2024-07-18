<?php
session_start();
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['resetpassword'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $role = $_POST['staffrole'];
  $securityquestion = $_POST['security_question'];
  $securityanswer = md5($_POST['security_answer']);

  if (empty($role) || empty($securityquestion)  || empty($securityanswer)) {
    header("Location: ../reset_password?e=Some Information seems to be Missing!.");
    exit();
  }
  else {
    $check_credentials = $user->Checkcredentials($role, $securityquestion, $securityanswer);
    if ($check_credentials == 1){
        $create_reset_session = $user->create_reset_session($role);
        header("Location: ../new_password?s=Details Successfully Verified!.");
        exit();
    }
    else{
        header("Location: ../reset_password?e=Incorrect Information Provided!.");
        exit();
    }
  }

}