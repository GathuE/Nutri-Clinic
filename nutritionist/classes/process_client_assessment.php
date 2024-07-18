<?php
error_reporting(E_ALL & E_NOTICE);
ini_set('display_errors', 1);

if (isset($_POST['save_assessment'])) {
  include 'users.class.php';
  $user = new ManageUsers();

  $clientid = $_POST['client_id'];

  $clientname = $_POST['client_name'];
  $clientphone = $_POST['client_phone'];
  $weight = $_POST['weight'];
  $height = $_POST['height'];
  $bmi = $_POST['bmi'];
  $waistcircumference = $_POST['waistcircumference'];
  $ageyears = $_POST['years'];
  $agemonths = $_POST['months'];
  $agesum = $_POST['age'];
  $gender = $_POST['gender'];
  $pregnant = $_POST['pregnant'];
  $lactating = $_POST['lactating'];
  $fatpercentage = $_POST['fat_percentage'];
  $bonemass = $_POST['bone_mass'];
  $visceralfat = $_POST['visceral_fat'];
  $musclemass = $_POST['muscle_mass'];
  $physiquerating = $_POST['physique_rating'];
  $bmr = $_POST['bmr'];
  $metabolicage = $_POST['metabolic_age'];
  $bodywater = $_POST['body_water'];
  $biochemicalassessment = $_POST['biochemical_assessment'];
  $clinicalassessment = $_POST['clinical_assessment'];
  $ip_address = $_SERVER['REMOTE_ADDR'];
  $date = date("d-m-Y");
  $time = date("H:i");

  $history_record = $user->CheckHistory($clientname,$clientphone);
  if ($history_record == 0) {
    header("Location: ../start_assessment?view=$clientid&e=Patient History Not Filled!!.");
    exit();
  }
  else{
    $assessment_record = $user->CheckAssessment($clientname,$clientphone);
    if ($assessment_record == 0) {
        $save_assessment = $user->SaveAssessment($clientname,$clientphone,$weight,$height,$bmi,$waistcircumference,$ageyears,$agemonths,$agesum,$gender,$pregnant,$lactating,$fatpercentage,$bonemass,$visceralfat,$musclemass,$physiquerating,$bmr,$metabolicage,$bodywater,$biochemicalassessment,$clinicalassessment,$ip_address,$date,$time);
        if ($save_assessment == 1) {
            header("Location: ../final_assessment?view=$clientid&s=Assessment Saved!!.");
            exit();
            }
            else{
              header("Location: ../proceed_assessment?view=$clientid&e=Assessment Data Exists!!.");
              exit();
            }
    }
    else{
        $update_assessment = $user->UpdateAssessment($clientname,$clientphone,$weight,$height,$bmi,$waistcircumference,$ageyears,$agemonths,$agesum,$gender,$pregnant,$lactating,$fatpercentage,$bonemass,$visceralfat,$musclemass,$physiquerating,$bmr,$metabolicage,$bodywater,$biochemicalassessment,$clinicalassessment,$ip_address,$date,$time);
        if ($update_assessment == 1) {
            header("Location: ../final_assessment?view=$clientid&s=Assessment Updated!!.");
            exit();
            }
            else{
              header("Location: ../proceed_assessment?view=$clientid&e=Assessment Data Exists!!.");
              exit();
            }

    }

  }

}