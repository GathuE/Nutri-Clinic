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
		$page_title = "Profile Manager";


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
							<hr>
							<!-- Place Info Cards Here -->
                           
							<!-- Place Other Contents Here -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" id="profile_card">
                                        <img id="profile_img" src="img/userimages/<?php echo $profile_pic;?>">
                                            <div class="row" id="profile_row">
                                                <div class="col-sm-12 col-md-12">
                                                   <p>Name : <?php echo $username;?> </p> 
                                                   <p>Role : <?php echo $role;?> </p> 
                                                   <p>Phone Number : <?php echo $phonenumber;?> </p> 
                                                   <p>Email : <?php echo $email;?> </p> 
                                                </div>
                                            </div> 
                                            <div class="card-action">
                                                <a class="btn btn-success" href="change_password">Change Password</a> &nbsp;
                                                <a class="btn btn-success" href="change_question">Change Security Question</a>
                                            </div>
                                           
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