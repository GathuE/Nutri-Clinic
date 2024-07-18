<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['user_verified'])) {
  header("Location:reset_password?e=Unauthorized Acess!!.");
  exit();
}
else 
	{
		$title = "Firm Name || New Password";
		$page_title = "New Password";

		
		$id = $_SESSION['ID'];
		$username = $_SESSION['username'];
		$role = $_SESSION['role'];
		$email = $_SESSION['email'];

?>
        <!-- Header Included Here -->
        <?php include 'includes/header.php' ?>
        
        <div class="row" id="login_row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card" id="login_card">
                    <div class="card-body" id="login_card_body">
                            <!-- Error Reporting Included Here -->
                            <?php include 'includes/errors.php' ?>
        
                            <img id="login_img" src="assets/img/logo.png">
                            <h4 class="card-title">Set New Password</h4>
                            <br>
                            <form method="post" action="classes/new_password">
                                <input type="hidden" class="form-control input-pill" name="user_id" id="user_id" value="<?php echo $id ?>">
                                <input type="hidden" class="form-control input-pill" name="user_role" id="user_role" value="<?php echo $role ?>">
                                <input type="hidden" class="form-control input-pill" name="user_email" id="user_email" value="<?php echo $email ?>">
                                
                               
                                <div class="form-group" id="login_form_group">
                                        <input type="password" class="form-control input-pill" name="new_password" id="new_password" oninput="validatePassword()" placeholder="Enter New Password.." required>
                                        <div id="passwordMessage" style="color: red;display: block; margin-top: 5px;"></div>
                                </div>

                                
                                <div class="form-group" id="login_form_group">
                                        <input type="password" class="form-control input-pill" name="confirm_password" id="confirm_password" oninput="validatePassword()" placeholder="Confirm Password.." required>
                                        <div id="confirmMessage" style="color: red;"></div>
                                </div>

                                <div class="card-action">
                                    <button class="btn btn-success" type="submit" name="newpassword" id="newpassword" disabled>Set New Password</button>
                                </div>
                            </form>
                            <div><a href ="index">Back Home</a></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Included Here -->
        <?php include 'includes/footer.php' ?>	


<?php
    }
?>







