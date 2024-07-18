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
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE email=? AND password=? AND status ='Active'");
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
    function Checkcredentials($role, $securityquestion, $securityanswer){
      $query = $this->dbh->prepare("SELECT * FROM backend_users WHERE role=? AND question=? AND answer=?");
      $values = array($role, $securityquestion, $securityanswer);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;

    }
    function create_reset_session($role){
      $query = $this->dbh->query("SELECT * FROM backend_users WHERE role='$role'");
      $user = $query->fetch();
      $_SESSION['ID'] = $user['ID'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['user_verified'] = 1;
    }

    function UpdatePassword($password) {
      $id = $_SESSION['ID'];
      $query = $this->dbh->prepare("UPDATE backend_users SET password=? WHERE ID = $id;");
      $values = array($password);
      $query->execute($values);
      $resultCheck = $query->rowCount();
      return $resultCheck;
    }
    
  }

 ?>
