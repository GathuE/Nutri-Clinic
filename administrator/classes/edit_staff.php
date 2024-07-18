<?php
error_reporting(0);
ini_set('display_errors', 1);

if (isset($_POST['editstaff'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $staffid = $_POST['staffid'];
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


  $staff_record = $user->ExistingStaff($name,$phone);
  if ($staff_record == 0) {

     //move file to Licenses Folder
   move_uploaded_file($_FILES["profilepicture"]["tmp_name"],"../img/userimages/".$_FILES["profilepicture"]["name"]);

      $update_staff = $user->UpdateStaff($name,$role,$profile,$phone,$email,$password,$question,$answer,$ip_address,$time,$date);
      if ($update_staff == 1) {
          header("Location: ../users?s=$role Updated!.");
          exit();
          }
    }
    else{
      header("Location: ../edit_details?edit=$staffid&e=$role Exists!.");
      exit();
    }

}
  
?>