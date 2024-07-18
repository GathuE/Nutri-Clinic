<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Profile";
		$page_title = "Change Password";

		
		$id = $_SESSION['ID'];
		$username = $_SESSION['username'];
		$role = $_SESSION['role'];
		$profile_pic = $_SESSION['profile_pic'];
		$phonenumber = $_SESSION['phonenumber'];
		$email = $_SESSION['email'];
		
?>
<!-- Header Included Here -->
<?php include 'includes/header.php' ?>

	<div class="wrapper">

		<!-- Top Nav Included Here -->
		<?php include 'includes/top_nav.php' ?>

		<!-- Sidebar Included Here -->
		<?php include 'includes/sidebar_nav.php' ?>

		<div class="main-panel">
				<div class="content">
						<div class="container-fluid">
							<div class="row">
								<div class="col">
									<h4 class="page-title"><?php echo $page_title ?></h4>
								</div>
								<div class="col">
									<?php include 'includes/errors.php'; ?>
								</div>
							</div>
							
							<!-- Place Other Contents Here -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card"> 
                                        <form method="post" action="classes/change_password">
                                            <div class="row" id="profile_row">
                                                <input type="hidden" class="form-control input-full" name="user_id" value="<?php echo $_SESSION['ID']; ?>">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">New Password :</label>
                                                        <div class="col-md-8 p-0">
                                                            <input type="password" class="form-control input-full" name="password" id="password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Confirm New Password :</label>
                                                        <div class="col-md-8 p-0">
                                                            <input type="password" class="form-control input-full" name="confirm_password" id="confirm_password" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-action">
                                                <button  class="btn btn-success" type="submit" name="changepassword">Submit</button>
                                                <button  class="btn btn-danger"  type="reset" >Cancel</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
							
							
						</div>
				</div>

			<!-- Guide Footer Included Here -->
			<?php include 'includes/guide_footer.php' ?>
		</div>
	</div>

	<!-- License Modal Included Here -->
	<?php include 'includes/license_modal.php' ?>	

	<!-- Footer Included Here -->
	<?php include 'includes/footer.php' ?>	
	
<?php }
?>