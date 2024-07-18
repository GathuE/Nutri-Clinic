<?php
  session_start();
  error_reporting(E_ALL & E_NOTICE);

  // Set timezone
  date_default_timezone_set('Africa/Nairobi');
  
  include_once 'db.class.php';

  class ManageUsers {
    public $dbh;

    function __construct() {
      $db_connection = new Dbh;
      $this->dbh = $db_connection->connect();
      return $this->dbh;
    }

    function Checkstatus($email, $password){
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE email=? AND password=? AND status ='1'");
      $values = array($email, $password);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }
    function CheckSuperAdmin($email){
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE email=? AND role ='SuperAdministrator'");
      $values = array($email);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }
    function CheckAdmin($email){
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE email=? AND role ='Administrator'");
      $values = array($email);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }
    function CheckReceptionist($email){
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE email=? AND role ='Receptionist'");
      $values = array($email);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }
    function CheckNutritionist($email){
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE email=? AND role ='Nutritionist'");
      $values = array($email);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }
    function Login($email, $password) {
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE email=? AND password=?");
      $values = array($email, $password);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }
    function create_session($email) {
      $query = $this->dbh->query("SELECT * FROM backend_users WHERE email='$email'");
      $user = $query->fetch();
      $_SESSION['ID'] = $user['ID'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['profile_pic'] = $user['profile_pic'];
      $_SESSION['phonenumber'] = $user['phonenumber'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['logged_in'] = 1;
    }

    function UpdatePassword($password) {
      $id = $_SESSION['ID'];
      $query = $this->dbh->prepare("UPDATE backend_users SET password=? WHERE ID = $id;");
      $values = array($password);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    function UpdateQuestion($question,$answer) {
      $id = $_SESSION['ID'];
      $query = $this->dbh->prepare("UPDATE backend_users SET question=?, answer=? WHERE ID = $id;");
      $values = array($question,$answer);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    function  CheckStaff($role,$email) {
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE role=? AND email=?");
      $values = array($role,$email);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      if ($resultCheck == 1) {
        $result = $query->fetchAll();
        return $result;
      } else {
        return $resultCheck;
      }
    }

    function EnrollStaff($name,$role,$profile,$phone,$email,$password,$question,$answer,$ip_address,$time,$date) {
      $query = $this->dbh->prepare("INSERT INTO backend_users (username, role, profile_pic, phonenumber, email, password, question, answer, ip_address, time, date) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
      $values = array($name,$role,$profile,$phone,$email,$password,$question,$answer,$ip_address,$time,$date);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    function  CheckHistory($clientid,$clientname,$clientphone) {
      $query = $this->dbh->prepare("SELECT * FROM walkin_clienthistory WHERE client_code=? AND client_name=? AND client_phone=?");
      $values = array($clientid,$clientname,$clientphone);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      if ($resultCheck == 1) {
        $result = $query->fetchAll();
        return $result;
      } else {
        return $resultCheck;
      }
    }


    function SaveHistory($clientid,$clientname,$clientphone,$pc,$hpc,$mhx,$fmhx,$shx,$dhx,$ip_address,$date,$time) {
      $query = $this->dbh->prepare("INSERT INTO walkin_clienthistory (client_code,client_name,client_phone, pc, hpc, mhx, fmhx, shx, dhx, ip_address, date, time) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
      $values = array($clientid,$clientname,$clientphone,$pc,$hpc,$mhx,$fmhx,$shx,$dhx,$ip_address,$date,$time);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }
    function UpdateHistory($clientname,$clientphone,$pc,$hpc,$mhx,$fmhx,$shx,$dhx,$ip_address,$date,$time) {
      $query = $this->dbh->prepare("UPDATE walkin_clienthistory SET client_name=?, client_phone=?, pc=?, hpc=?, mhx=?, fmhx=?, shx=?, dhx=?, ip_address=?, date=?, time=?  WHERE client_phone = $clientphone;");
      $values = array($clientname,$clientphone,$pc,$hpc,$mhx,$fmhx,$shx,$dhx,$ip_address,$date,$time);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }


    function  CheckAssessment($clientname,$clientphone) {
      $query = $this->dbh->prepare("SELECT * FROM walkin_assessmentdata WHERE client_name=? AND client_phone=?");
      $values = array($clientname,$clientphone);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      if ($resultCheck == 1) {
        $result = $query->fetchAll();
        return $result;
      } else {
        return $resultCheck;
      }
    }


    function SaveAssessment($clientname,$clientphone,$weight,$height,$bmi,$waistcircumference,$ageyears,$agemonths,$agesum,$gender,$pregnant,$lactating,$fatpercentage,$bonemass,$visceralfat,$musclemass,$physiquerating,$bmr,$metabolicage,$bodywater,$biochemicalassessment,$clinicalassessment,$ip_address,$date,$time) {
      $query = $this->dbh->prepare("INSERT INTO walkin_assessmentdata (client_name, client_phone, weight, height, bmi, waistcircumference, age_years, age_months, age_sum, gender, pregnant, lactating, fat_percentage, bone_mass, visceral_fat, muscle_mass, physique_rating, bmr, metabolic_age, body_water, biochemical_assessment, clinical_assessment, ip_address, date, time) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $values = array($clientname,$clientphone,$weight,$height,$bmi,$waistcircumference,$ageyears,$agemonths,$agesum,$gender,$pregnant,$lactating,$fatpercentage,$bonemass,$visceralfat,$musclemass,$physiquerating,$bmr,$metabolicage,$bodywater,$biochemicalassessment,$clinicalassessment,$ip_address,$date,$time);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }


    function UpdateAssessment($clientname,$clientphone,$weight,$height,$bmi,$waistcircumference,$ageyears,$agemonths,$agesum,$gender,$pregnant,$lactating,$fatpercentage,$bonemass,$visceralfat,$musclemass,$physiquerating,$bmr,$metabolicage,$bodywater,$biochemicalassessment,$clinicalassessment,$ip_address,$date,$time) {
      $query = $this->dbh->prepare("UPDATE walkin_assessmentdata SET client_name=?, client_phone=?, weight=?, height=?, bmi=?, waistcircumference=?, age_years=?, age_months=?, age_sum=?, gender=?, pregnant=?, lactating=?, fat_percentage=?, bone_mass=?, visceral_fat=?, muscle_mass=?, physique_rating=?, bmr=?, metabolic_age=?, body_water=?, biochemical_assessment=?, clinical_assessment=?, ip_address=?, date=?, time=?  WHERE client_phone = $clientphone;");
      $values = array($clientname,$clientphone,$weight,$height,$bmi,$waistcircumference,$ageyears,$agemonths,$agesum,$gender,$pregnant,$lactating,$fatpercentage,$bonemass,$visceralfat,$musclemass,$physiquerating,$bmr,$metabolicage,$bodywater,$biochemicalassessment,$clinicalassessment,$ip_address,$date,$time);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }


    function  CheckMeal($meal_id,$foods_id,$servings_id,$amount) {
      $query = $this->dbh->prepare("SELECT * FROM walkin_mealhistory WHERE id=? AND foods_id=? AND servings_id=? AND amount=?");
      $values = array($meal_id,$foods_id,$servings_id,$amount);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      if ($resultCheck == 1) {
        $result = $query->fetchAll();
        return $result;
      } else {
        return $resultCheck;
      }
    }


    function UpdateMeal($meal_id,$foods_id,$servings_id,$amount) {
      $query = $this->dbh->prepare("UPDATE walkin_mealhistory SET id=?, foods_id=?, servings_id=?, amount=? WHERE id= $meal_id;");
      $values = array($meal_id,$foods_id,$servings_id,$amount);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }


  }

 ?>
