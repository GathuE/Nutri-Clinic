<?php
  session_start();
  session_unset();
  session_destroy();

  header("Location: ../index?s=Successfully Logged Out.");

  exit();
 ?>