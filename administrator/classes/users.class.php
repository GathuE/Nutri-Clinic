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

    function  CheckStaff($role) {
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE role=?");
      $values = array($role);
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

    function ExistingStaff($name,$phone) {
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE username=? AND phonenumber=?");
      $values = array($name,$phone);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      if ($resultCheck == 1) {
        $result = $query->fetchAll();
        return $result;
      } else {
        return $resultCheck;
      }
    }

    function UpdateStaff($name,$role,$profile,$phone,$email,$password,$question,$answer,$ip_address,$time,$date) {
      $id = $_POST['staffid'];
      $query = $this->dbh->prepare("UPDATE backend_users SET username=?, role=?, profile_pic=?, phonenumber=?, email=?, password=?, question=?, answer=?, ip_address=?, time=?, date=? WHERE ID = $id;");
      $values = array($name,$role,$profile,$phone,$email,$password,$question,$answer,$ip_address,$time,$date);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    function  CheckPayment($staffid,$transactioncode){
      $query = $this->dbh->prepare("SELECT * FROM referral_payments WHERE refferer_identity=? AND transaction_code=?");
      $values = array($staffid,$transactioncode);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      if ($resultCheck == 1) {
        $result = $query->fetchAll();
        return $result;
      } else {
        return $resultCheck;
      }
    }

    function  RecordTransation($staffid,$totalrevenue,$paidamount,$balance,$transactioncode,$ip_address,$date,$time) {
      $query = $this->dbh->prepare("INSERT INTO referral_payments (refferer_identity, total_revenue, total_paidout, balance, transaction_code, ip_address, date, time) VALUES (?,?,?,?,?,?,?,?)");
      $values = array($staffid,$totalrevenue,$paidamount,$balance,$transactioncode,$ip_address,$date,$time);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    function CheckNutritionistApproval($userid){
      $query = $this->dbh->prepare("SELECT * FROM nutritionists WHERE ID=? AND status ='Approved'");
      $values = array($userid);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }
    function CheckPractitionerApproval($userid){
      $query = $this->dbh->prepare("SELECT * FROM practitioners WHERE ID=? AND status ='Approved'");
      $values = array($userid);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }

    function ApproveNutritionist($userid) {
      $query = $this->dbh->prepare("UPDATE nutritionists SET status = 'Approved' WHERE ID=?;");
      $values = array($userid);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    function ApprovePractitioner($userid) {
      $query = $this->dbh->prepare("UPDATE practitioners SET status = 'Approved' WHERE ID=?;");
      $values = array($userid);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    function RejectStatus($userid){
      $query = $this->dbh->prepare("SELECT * FROM nutritionists WHERE ID=? AND status ='Rejected'");
      $values = array($userid);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }

    function RejectPractitionerStatus($userid){
      $query = $this->dbh->prepare("SELECT * FROM practitioners WHERE ID=? AND status ='Rejected'");
      $values = array($userid);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }
    function RejectNutritionist($userid) {
      $query = $this->dbh->prepare("UPDATE nutritionists SET status = 'Rejected' WHERE ID=?;");
      $values = array($userid);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    function RejectPractitioner($userid) {
      $query = $this->dbh->prepare("UPDATE practitioners SET status = 'Rejected' WHERE ID=?;");
      $values = array($userid);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }
  }

 ?>
