<?php
session_start();
error_reporting(E_ALL);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Client Transactions";
		$page_title = "Transaction Details";

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
									$sql = "SELECT * FROM walkin_clients WHERE ID='$id'";
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
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-md-6">
														<span>
															Name : <b><?php echo htmlentities($result->clientname);?></b><br>
															Phone Number : <b><?php echo htmlentities($result->phonenumber);?></b><br>
															Visit : <b><?php echo htmlentities($result->status);?></b>
														</span>
													</div>
													<div class="col-md-6">
														<span>
															Service : <b><?php echo htmlentities($result->service);?></b><br>
															Cost : <b>Ksh <?php echo htmlentities($result->cost);?></b><br>
															Date : <b><?php echo htmlentities($result->date);?></b><br>	
															Mode of Payment : <b><?php echo htmlentities($result->payment_mode);?></b><br>
															Mpesa Code : <b><?php echo htmlentities($result->mpesa_code);?></b><br>
														</span>
													</div>
												</div>
											<form method="post" action="classes/print_receipt">

												<input type="hidden" name="client_code" value="<?php echo htmlentities($result->ID);?>">
												<input type="hidden" name="employee_code" value="<?php echo $_SESSION['username'];?>">
												

												<div class="card-action">
														<input type="submit" name="submit" class="btn btn-success btn-xs" value="Print Receipt" >
                                                        <a href="clients" class="btn btn-warning btn-xs">Back</a>
                                                </div>
											</form>
												
												
													

											</div>
										</div>
									</div>
								</div>

								<?php }} 
									else{
										echo '<p>No Data Found !!</p>';
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