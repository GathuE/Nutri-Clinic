<?php
error_reporting(E_ALL & E_NOTICE);
ini_set('display_errors', 1);

if (isset($_POST['editmeal'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $meal_id = $_POST['meal_id'];
  $client_id = $_POST['client_id'];
  $meal = $_POST['meal'];
  $foods_id = $_POST['foods_id'];
  $servings_id = $_POST['servings_id'];
  $amount = $_POST['amount'];


  $meal_availability = $user->CheckMeal($meal_id,$foods_id,$servings_id,$amount);
  if($meal_availability == 0){
      $update_meal = $user->UpdateMeal($meal_id,$foods_id,$servings_id,$amount);
      if($update_meal == 1){
        header("Location: ../walkin_mealhistory?view=$client_id&s=Update Successful!.");
        exit();
      }
  }
  else{
    header("Location: ../edit_meal?edit=$meal_id&e=This Meal Exists!.");
    exit();
  }
}
?>