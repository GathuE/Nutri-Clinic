<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Staff Details";
		$page_title = "Staff Information";


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

							<?php 

                                error_reporting(E_ALL & E_NOTICE);
                                include 'includes/db_conn.php'; 
                                $id=$_GET['view'];
                                $sql = "SELECT * FROM backend_users WHERE ID='$id'";
                                $query= $conn->prepare($sql);
                                $query-> execute();
                                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                if($query -> rowCount() > 0)
                                {
                                foreach($results as $result)
                                {
                                
                             ?>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" id="profile_card">
										<img id="profile_img" src="img/userimages/<?php echo htmlentities($result->profile_pic);?>">
											<div class="row">
												<div class="col-sm-12 col-md-12">
                                                   <p>Name : <?php echo htmlentities($result->username);?> </p> 
                                                   <p>Role : <?php echo htmlentities($result->role);?> </p> 
                                                   <p>Phone Number : <?php echo htmlentities($result->phonenumber);?> </p> 
                                                   <p>Email : <?php echo htmlentities($result->email);?> </p> 
												   <p>Enrollment Date : <?php echo htmlentities($result->date);?> </p> 
												   <p>Status : <?php echo htmlentities($result->status);?> </p> 
                                                </div>
											</div>
                                        
										<form enctype="multipart/form-data" method="post" action="classes/update_staff_account">
                                        	<input type="hidden" name="staffid" id="staffid" value="<?php echo htmlentities($id)?> ">
											<input type="hidden" name="staffemail" id="staffemail" value="<?php echo htmlentities($email)?> ">
											<input type="hidden" name="staffstatus" id="staffstatus" value="<?php echo htmlentities($result->status)?> ">
                                            <div class="card-action">
                                                <a class="btn btn-info" href="users">All Users</a> &nbsp;
												<button  class="btn btn-danger" type="submit" name="updateaccount" id="updateaccount" onclick="alert('You are about to Update the User Account Status')">Update Account</button>
                                            </div>
                                           
                                    </div>
                                </div>
                                
                            </div>

							<?php }} 
									else{
                                        echo 'No Data Found !!';
                                        } 
                            ?>
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