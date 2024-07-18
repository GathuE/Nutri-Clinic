<?php
error_reporting(E_ALL & E_NOTICE);
ini_set('display_errors', 1);

if (isset($_POST['changequestion'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $id = $_POST['user_id'];
  $question = $_POST['security_question'];
  $answer = md5($_POST['security_answer']);

  if (empty($question)) {
    header("Location: ../change_question?e=Please Choose a Question!!");
    exit();
  } elseif (empty($answer)) {
    header("Location: ../change_question?e=Please Provide an Answer!!");
    exit();
  }
  else{
        $question_update = $user->UpdateQuestion($question,$answer);
        if ($question_update == 1) {
            header("Location: ../profile?s=Update Successful!.");
            exit();
          }
          else{
            header("Location: ../change_question?e=Try a Different Question!!.");
            exit();
          }
  }

}
  
?>