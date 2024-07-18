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


    function  CheckClient($clientphonenumber,$service,$date) {
      $query = $this->dbh->prepare("SELECT * FROM walkin_clients WHERE phonenumber=? AND service=? AND date=?");
      $values = array($clientphonenumber,$service,$date);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      if ($resultCheck == 1) {
        $result = $query->fetchAll();
        return $result;
      } else {
        return $resultCheck;
      }
    }

    function EnrollClient($status,$clientname,$clientphonenumber,$service,$cost,$paymentmode,$transactioncode,$ip_address,$time,$date) {
      $query = $this->dbh->prepare("INSERT INTO walkin_clients (status, clientname, phonenumber, service, cost, payment_mode, mpesa_code, ip_address, time, date) VALUES (?,?,?,?,?,?,?,?,?,?)");
      $values = array($status,$clientname,$clientphonenumber,$service,$cost,$paymentmode,$transactioncode,$ip_address,$time,$date);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }

    
  }

 ?>
