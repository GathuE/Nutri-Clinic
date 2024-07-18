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
                                $sql = "SELECT * FROM practitioners 
								INNER JOIN practitioner_data ON practitioners.ID=practitioner_data.practitioner_id 
                                WHERE practitioners.ID='$id'";
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
                                    <div class="card" id="employee_card">
										<h6 id="employee_heading">Employee Details</h6>
											<div class="row">
												<div class="col-sm-12 col-md-12">
                                                   <p>Name : <?php echo htmlentities($result->name);?><br> 
                                                   Specialty : <?php echo htmlentities($result->specialty);?><br> 
                                                  Region : <?php echo htmlentities($result->region);?><br>   
                                                   Phonenumber : <?php echo htmlentities($result->phonenumber);?><br> 
												   Email : <?php echo htmlentities($result->email);?> </p> 
                                                </div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-12 col-md-12">
												<hr>
												<h6>Applicant's Resume</h6>
													<iframe id="resume_viewer" src="https://docs.google.com/viewerng/viewer?url=http://infolab.stanford.edu/pub/papers/google.pdf&embedded=true" frameborder="0" height="300%" width="90%">
													</iframe>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12 col-md-12">
												<hr>
												<h6>Applicant's License</h6>
													<iframe id="license_viewer" src="https://docs.google.com/viewerng/viewer?url=http://infolab.stanford.edu/pub/papers/google.pdf&embedded=true" frameborder="0" height="300%" width="90%">
													</iframe>
												</div>
											</div>
											<form method="post" action="classes/approve_practitioner">
												<input type="hidden" name="userid" value="<?php echo htmlentities($result->ID); ?>">
												<input type="hidden" name="username" value="<?php echo htmlentities($result->name); ?>">
												
												
												<div class="card-action">
													<button type="submit" name="approve" class="btn btn-success">Approve Application</button> &nbsp;
													<button type="submit" name="reject" class="btn btn-success">Reject Application</button>
												</div>

											</form>
											
                                            
                                           
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