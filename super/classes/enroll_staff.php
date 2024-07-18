<?php
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['enrollstaff'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $name = $_POST['staffname'];
  $role = $_POST['staffrole'];
  $profile = $_FILES['profilepicture']['name'];
  $phone = $_POST['phonenumber'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $question = $_POST['security_question'];
  $answer = md5($_POST['security_answer']);
  $ip_address = $_SERVER['REMOTE_ADDR'];
  $date = date("d-m-Y");
  $time = date("H:i");


  $staff_record = $user->CheckStaff($role);
  if ($staff_record == 0) {

     //move file to Licenses Folder
   move_uploaded_file($_FILES["profilepicture"]["tmp_name"],"../img/userimages/".$_FILES["profilepicture"]["name"]);

      $enroll_staff = $user->EnrollStaff($name,$role,$profile,$phone,$email,$password,$question,$answer,$ip_address,$time,$date);
      if ($enroll_staff == 1) {
          header("Location: ../users?s=$role Enrolled!.");
          exit();
          }
    }
    else{
      header("Location: ../new_staff?e=$role Exists!.");
      exit();
    }

}
  
?>